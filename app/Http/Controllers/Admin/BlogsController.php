<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
    public function store(Request $request)
    {
        // Validasi manual supaya bisa kontrol pesan error sendiri
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'title.required' => 'Judul blog wajib diisi.',
            'content.required' => 'Konten blog wajib diisi.',
            'category_id.required' => 'Kategori harus dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'photos.*.image' => 'File harus berupa gambar.',
            'photos.*.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'photos.*.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('admin.blogs')
                ->withInput() // supaya input tetap tersimpan di form
                ->with('error', $validator->errors()->first());
        }

        try {
            $validatorPhotos = [];
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('blogs_photos', 'public');
                    $validatorPhotos[] = basename($path);
                }
            }
            $request->merge(['photos' => json_encode($validatorPhotos)]);

            // Simpan ke database
            Blogs::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'writer' => Auth()->user()->name,
                'photos' => $validatorPhotos ? json_encode($validatorPhotos) : null,
                'category_id' => $request->category_id,
            ]);

            // Redirect sukses
            return redirect()->route('admin.blogs')->with('success', 'Blog created successfully.');

        } catch (\Exception $e) {
            // Tangani error database (misalnya constraint violation)
            return redirect()->route('admin.blogs')
                ->with('error', 'Terjadi kesalahan saat menyimpan blog: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.blogs')
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        try {
            // Ambil data blog lama
            $blog = Blogs::findOrFail($id);

            // Default: pakai foto lama
            $photos = json_decode($blog->photos, true) ?? [];

            // Jika upload foto baru
            if ($request->hasFile('photos')) {
                $newPhotos = [];

                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('blogs_photos', 'public');
                    $newPhotos[] = basename($path);
                }

                // HANYA jika upload ada → ganti foto lama dengan foto baru
                $photos = $newPhotos;
            }

            // Update data blog + foto
            $blog->update([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'photos' => json_encode($photos), // pakai foto lama atau foto baru
                'status' => $request->status,
            ]);

            return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.blogs')
                ->with('error', 'Terjadi kesalahan saat memperbarui blog: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $blog = Blogs::findOrFail($id);

            // Hapus semua foto terkait
            if (!empty($blog->photos)) {
                $photos = json_decode($blog->photos, true);

                foreach ($photos as $photo) {
                    $filePath = storage_path('app/public/blogs_photos/' . $photo);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            // Hapus data blog
            $blog->delete();

            return redirect()->route('admin.blogs')->with('success', 'Blog deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.blogs')
                ->with('error', 'Terjadi kesalahan saat menghapus blog: ' . $e->getMessage());
        }
    }
}
