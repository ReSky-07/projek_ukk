@include('admin.layouts.header')

<body class="sb-nav-fixed">
    @include('admin.layouts.navbar')

    <div id="layoutSidenav">
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Data Peminjaman</h1>

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="GET" class="row mb-3">

                        <div class="col-md-3">
                            <label>Dari Tanggal</label>
                            <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                        </div>

                        <div class="col-md-3">
                            <label>Sampai Tanggal</label>
                            <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary me-2">Filter</button>

                            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">
                                Reset
                            </a>
                        </div>

                    </form>

                    <a
                        href="{{ route('admin.peminjaman.cetak', request()->only(['from','to'])) }}"
                        target="_blank"
                        class="btn btn-danger mb-3">
                        Cetak PDF
                    </a>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Siswa</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th>Tanggal Dikembalikan</th>
                                    <th>Status</th>
                                    <th>Denda</th>
                                    <th>Aksi</th>
                                </tr>

                                @foreach($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->buku->judul }}</td>
                                    <td>{{ $row->tanggal_pinjam }}</td>
                                    <td>{{ $row->tanggal_kembali }}</td>
                                    <td>{{ $row->tanggal_dikembalikan }}</td>

                                    {{-- STATUS --}}
                                    <td>
                                        @if($row->status == 'menunggu')
                                        <span class="badge bg-warning">Menunggu</span>
                                        @elseif($row->status == 'dipinjam')
                                        <span class="badge bg-primary">Dipinjam</span>
                                        @elseif($row->status == 'menunggu_konfirmasi')
                                        <span class="badge bg-info">Menunggu Pengembalian</span>
                                        @elseif($row->status == 'dikembalikan')
                                        <span class="badge bg-success">Dikembalikan</span>
                                        @endif
                                    </td>

                                    {{-- DENDA --}}
                                    <td>
                                        Rp {{ number_format($row->denda ?? 0) }}
                                    </td>

                                    {{-- AKSI --}}
                                    <td>

                                        {{-- KONFIRMASI PINJAM --}}
                                        @if($row->status == 'menunggu')
                                        <form action="{{ route('admin.konfirmasi',$row->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                Konfirmasi Pinjam
                                            </button>
                                        </form>

                                        {{-- KONFIRMASI PENGEMBALIAN + INPUT DENDA --}}
                                        @elseif($row->status == 'menunggu_konfirmasi')
                                        <form action="{{ route('admin.konfirmasi',$row->id) }}" method="POST">
                                            @csrf

                                            <div class="mb-2">
                                                <input
                                                    type="number"
                                                    name="denda"
                                                    class="form-control form-control-sm"
                                                    placeholder="Input denda"
                                                    min="0"
                                                    required>
                                            </div>

                                            <button class="btn btn-primary btn-sm">
                                                Konfirmasi Kembali
                                            </button>
                                        </form>

                                        @else
                                        <span class="text-muted">-</span>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>

                </div>
            </main>

            @include('admin.layouts.footer')
        </div>
    </div>
</body>

</html>