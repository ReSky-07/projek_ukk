<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with('user', 'buku');

        // FILTER TANGGAL
        if ($request->filled('from') && $request->filled('to')) {

            // optional validasi
            if ($request->from > $request->to) {
                return back()->with('error', 'Tanggal tidak valid');
            }

            $query->whereBetween('tanggal_pinjam', [
                $request->from . ' 00:00:00',
                $request->to . ' 23:59:59'
            ]);
        }

        $data = $query->latest()->get();

        return view('admin.peminjaman.index', compact('data'));
    }

    public function konfirmasi(Request $request, $id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->status == 'menunggu') {

            if ($pinjam->buku->stok <= 0) {
                return back()->with('error', 'Stok buku habis');
            }

            $pinjam->update([
                'status' => 'dipinjam'
            ]);

            $pinjam->buku->decrement('stok');
        } elseif ($pinjam->status == 'menunggu_konfirmasi') {

            $pinjam->update([
                'status' => 'dikembalikan',
                'tanggal_dikembalikan' => now(),
                'denda' => $request->denda ?? 0
            ]);

            $pinjam->buku->increment('stok');
        }

        $request->validate([
            'denda' => 'nullable|integer|min:0'
        ]);

        return back()->with('success', 'Berhasil dikonfirmasi');
    }

    public function cetakPdf(Request $request)
    {
        $query = Peminjaman::with('user', 'buku');

        // FILTER TANGGAL
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('tanggal_pinjam', [$request->from, $request->to]);
        }

        $data = $query->latest()->get();

        $admin = auth()->user();
        $tanggal = now();

        $pdf = Pdf::loadView(
            'admin.peminjaman.pdf',
            compact('data', 'admin', 'tanggal', 'request')
        );

        return $pdf->stream('laporan-peminjaman.pdf');
    }
}
