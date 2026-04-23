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

    public function konfirmasi($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status == 'menunggu') {

            if ($pinjam->buku->stok <= 0) {
                return back()->with('error', 'Stok buku habis');
            }

            $pinjam->update([
                'status' => 'dipinjam'
            ]);

            // Kurangi stok saat disetujui
            $pinjam->buku->decrement('stok');
        }

        elseif ($pinjam->status == 'menunggu_konfirmasi') {

            $pinjam->update([
                'status' => 'dikembalikan',
                'tanggal_dikembalikan' => now()
            ]);

            $pinjam->buku->increment('stok');
        }

        return back()->with('success', 'Berhasil dikonfirmasi');
    }
}
