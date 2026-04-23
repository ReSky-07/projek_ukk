<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $bukuCount = Buku::count();
        $kategoriCount = Kategori::count();
        $peminjamanCount = Peminjaman::count();

        return view('admin.dashboard', compact(
            'userCount',
            'bukuCount',
            'kategoriCount',
            'peminjamanCount'
        ));
    }
}
