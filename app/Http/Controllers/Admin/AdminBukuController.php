<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminBukuController extends Controller
{
    /**
     * Tampilkan semua data buku
     */
    public function index()
    {
        $bukus = Buku::with('kategoris')->latest()->get();

        return view('admin.buku.index', compact('bukus'));
    }

    /**
     * Form tambah buku
     */
    public function create()
    {
        $kategoris = Kategori::all();

        return view('admin.buku.create', compact('kategoris'));
    }

    /**
     * Simpan data buku
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required|array',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $namaGambar = null;

        if ($request->hasFile('gambar')) {
            $namaGambar = $request->file('gambar')->store('buku', 'public');
        }

        $buku = Buku::create([
            'judul' => $request->judul,
            'stok' => $request->stok,
            'gambar' => $namaGambar
        ]);

        // SIMPAN KE PIVOT
        $buku->kategoris()->attach($request->kategori_id);

        return redirect()->route('admin.buku.index');
    }
    /**
     * Form edit buku
     */
    public function edit(Buku $buku)
    {
        $kategoris = Kategori::all();

        return view('admin.buku.edit', compact('buku', 'kategoris'));
    }

    /**
     * Update data buku
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required|array',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $namaGambar = $buku->gambar;

        if ($request->hasFile('gambar')) {

            if ($buku->gambar) {
                Storage::disk('public')->delete($buku->gambar);
            }

            $namaGambar = $request->file('gambar')->store('buku', 'public');
        }

        $buku->update([
            'judul' => $request->judul,
            'stok' => $request->stok,
            'gambar' => $namaGambar
        ]);

        // UPDATE PIVOT
        $buku->kategoris()->sync($request->kategori_id);

        return redirect()->route('admin.buku.index');
    }
    /**
     * Hapus data buku
     */
    public function destroy(Buku $buku)
    {
        if ($buku->gambar) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        return redirect()->route('admin.buku.index');
    }
}
