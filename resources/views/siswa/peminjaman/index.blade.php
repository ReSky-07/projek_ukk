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
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th>Status</th>
                                </tr>

                                @foreach($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->buku->judul }}</td>
                                    <td>{{ $row->tanggal_pinjam }}</td>
                                    <td>{{ $row->tanggal_kembali }}</td>
                                    <td>{{ $row->status }}</td>
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