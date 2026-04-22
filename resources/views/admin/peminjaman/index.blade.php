@include('admin.layouts.header')

<body class="sb-nav-fixed">
    @include('admin.layouts.navbar')

    <div id="layoutSidenav">
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Data Peminjaman</h1>

                    <div class="card">
                        <div class="card-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Siswa</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>

                                @foreach($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->buku->judul }}</td>
                                    <td>{{ $row->tanggal_pinjam }}</td>
                                    <td>{{ $row->tanggal_kembali }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td>

                                        @if($row->status == 'dipinjam')

                                        <form action="{{ route('admin.kembalikan',$row->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                Kembalikan
                                            </button>
                                        </form>

                                        @else
                                        <span class="badge bg-success">Selesai</span>
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