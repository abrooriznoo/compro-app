<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.string' => 'Nama kategori harus berupa teks.',
            'name.max' => 'Nama kategori maksimal 255 karakter.',
        ]);

        try {
            // Simpan ke database
            Categories::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            // Redirect sukses
            return redirect()->route('admin.categories')->with('success', 'Kategori berhasil ditambahkan.');

        } catch (\Exception $e) {
            // Tangani error database
            return redirect()->route('admin.categories')
                ->with('error', 'Terjadi kesalahan saat menyimpan kategori: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.string' => 'Nama kategori harus berupa teks.',
            'name.max' => 'Nama kategori maksimal 255 karakter.',
        ]);

        try {
            // Temukan kategori berdasarkan ID
            $category = Categories::findOrFail($id);

            // Update data kategori
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            // Redirect sukses
            return redirect()->route('admin.categories')->with('success', 'Kategori berhasil diperbarui.');

        } catch (\Exception $e) {
            // Tangani error database
            return redirect()->route('admin.categories')
                ->with('error', 'Terjadi kesalahan saat memperbarui kategori: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Temukan kategori berdasarkan ID
            $category = Categories::findOrFail($id);

            // Hapus kategori
            $category->delete();

            // Redirect sukses
            return redirect()->route('admin.categories')->with('success', 'Kategori berhasil dihapus.');

        } catch (\Exception $e) {
            // Tangani error database
            return redirect()->route('admin.categories')
                ->with('error', 'Terjadi kesalahan saat menghapus kategori: ' . $e->getMessage());
        }
    }
}
