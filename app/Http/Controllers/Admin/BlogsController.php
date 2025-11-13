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
        ], [
            'title.required' => 'Judul blog wajib diisi.',
            'content.required' => 'Konten blog wajib diisi.',
            'category_id.required' => 'Kategori harus dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('admin.blogs')
                ->withInput() // supaya input tetap tersimpan di form
                ->with('error', $validator->errors()->first());
        }

        try {
            // Simpan ke database
            Blogs::create([
                'title' => $request->title,
                'content' => $request->content,
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
        ], [
            'title.required' => 'Judul blog wajib diisi.',
            'content.required' => 'Konten blog wajib diisi.',
            'category_id.required' => 'Kategori harus dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('admin.blogs')
                ->withInput() // supaya input tetap tersimpan di form
                ->with('error', $validator->errors()->first());
        }

        try {
            $blog = Blogs::findOrFail($id);
            $blog->update([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
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
            $blog->delete();

            return redirect()->route('admin.blogs')->with('success', 'Blog deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.blogs')
                ->with('error', 'Terjadi kesalahan saat menghapus blog: ' . $e->getMessage());
        }
    }
}
