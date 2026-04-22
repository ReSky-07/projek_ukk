<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class AdminPeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with('user', 'buku')->latest()->get();

        return view('admin.peminjaman.index', compact('data'));
    }

    public function kembalikan($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => now()
        ]);

        $pinjam->buku->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}
