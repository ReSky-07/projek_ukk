<?php

    namespace App\Http\Controllers\Siswa;

    use App\Http\Controllers\Controller;
    use App\Models\Buku;
    use App\Models\Peminjaman;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class SiswaPeminjamanController extends Controller
    {
        public function index()
        {
            $bukus = Buku::with('kategori')->get();

            return view('siswa.buku.index', compact('bukus'));
        }

        public function create($id)
        {
            $buku = Buku::findOrFail($id);

            return view('siswa.buku.pinjam', compact('buku'));
        }

        public function store(Request $request)
        {
            $buku = Buku::findOrFail($request->buku_id);

            if ($buku->stok <= 0) {
                return back()->with('error', 'Stok habis');
            }

            Peminjaman::create([
                'user_id' => Auth::id(),
                'buku_id' => $buku->id,
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => now()->addDays(7),
                'status' => 'dipinjam'
            ]);

            $buku->decrement('stok');

            return redirect()->route('siswa.peminjaman.index')
                ->with('success', 'Buku berhasil dipinjam');
        }

        public function peminjaman()
        {
            $data = Peminjaman::with('buku')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();

            return view('siswa.peminjaman.index', compact('data'));
        }
        public function kembalikan($id)
        {
            $pinjam = Peminjaman::findOrFail($id);

            $pinjam->update([
                'status' => 'dikembalikan',
                'tanggal_dikembalikan' => now()
            ]);

            $pinjam->buku->increment('stok');

            return back()->with('success', 'Buku dikembalikan');
        }
    }
