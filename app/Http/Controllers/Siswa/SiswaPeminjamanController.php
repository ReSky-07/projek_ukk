<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaPeminjamanController extends Controller
{
    /**
     * Daftar buku + search + filter kategori
     */
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        // Search judul buku
        if ($request->filled('judul')) {
            $query->where('judul', 'like', '%' . $request->judul . '%');
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Urut terbaru
        $bukus = $query->latest()->get();

        // Ambil kategori untuk dropdown
        $kategoris = Kategori::all();

        return view('siswa.buku.index', compact('bukus', 'kategoris'));
    }

    /**
     * Form pinjam buku
     */
    public function create($id)
    {
        $buku = Buku::findOrFail($id);

        return view('siswa.buku.pinjam', compact('buku'));
    }

    /**
     * Simpan peminjaman
     */
    public function store(Request $request)
    {
        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => now()->addDays(7),
            'status' => 'dipinjam'
        ]);

        // Kurangi stok
        $buku->decrement('stok');

        return redirect()->route('siswa.peminjaman.index')
            ->with('success', 'Buku berhasil dipinjam');
    }

    /**
     * Riwayat peminjaman siswa
     */
    public function peminjaman()
    {
        $data = Peminjaman::with('buku')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.peminjaman.index', compact('data'));
    }

    /**
     * Siswa ajukan pengembalian
     */
    public function kembalikan($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        // Pastikan milik user yang login
        if ($pinjam->user_id != Auth::id()) {
            abort(403);
        }

        $pinjam->update([
            'status' => 'menunggu_konfirmasi'
        ]);

        return back()->with('success', 'Permintaan pengembalian dikirim');
    }
}
