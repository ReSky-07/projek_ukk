@include('siswa.layouts.header')

<body class="sb-nav-fixed">
    @include('siswa.layouts.navbar')

    <div id="layoutSidenav">
        @include('siswa.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Pinjaman Saya</h1>

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>

                                @foreach($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->buku->judul }}</td>
                                    <td>{{ $row->tanggal_pinjam }}</td>
                                    <td>{{ $row->tanggal_kembali }}</td>

                                    <td>
                                        @if($row->status == 'menunggu')
                                        <span class="badge bg-warning">Menunggu Konfirmasi</span>

                                        @elseif($row->status == 'dipinjam')
                                        <span class="badge bg-primary">Sedang Dipinjam</span>

                                        @elseif($row->status == 'menunggu_konfirmasi')
                                        <span class="badge bg-info">Menunggu Persetujuan Admin</span>

                                        @elseif($row->status == 'dikembalikan')
                                        <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($row->status == 'dipinjam')
                                        <form action="{{ route('siswa.kembalikan',$row->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">
                                                Ajukan Pengembalian
                                            </button>
                                        </form>

                                        @elseif($row->status == 'menunggu')
                                        <span class="text-muted">Menunggu Admin</span>

                                        @elseif($row->status == 'menunggu_konfirmasi')
                                        <span class="text-info">Diproses Admin</span>

                                        @else
                                        <span class="text-success">Selesai</span>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach

                            </table>

                        </div>
                    </div>

                </div>
            </main>

            @include('siswa.layouts.footer')
        </div>
    </div>
</body>

</html>