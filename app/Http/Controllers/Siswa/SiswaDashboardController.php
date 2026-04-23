<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // TOTAL BUKU (opsional, bisa dihapus kalau tidak mau global)
        $bukuCount = Buku::count();

        // DATA KHUSUS SISWA
        $dipinjam = Peminjaman::where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->count();

        $menunggu = Peminjaman::where('user_id', $userId)
            ->where('status', 'menunggu')
            ->count();

        $dikembalikan = Peminjaman::where('user_id', $userId)
            ->where('status', 'dikembalikan')
            ->count();

        return view('siswa.dashboard', compact(
            'bukuCount',
            'dipinjam',
            'menunggu',
            'dikembalikan'
        ));
    }
}
