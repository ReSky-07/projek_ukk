@include('siswa.layouts.header')

<body class="sb-nav-fixed">
    @include('siswa.layouts.navbar')

    <div id="layoutSidenav">
        @include('siswa.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Daftar Buku</h1>

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-body">

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Gambar</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($bukus as $buku)
                                    <tr>
                                        <td>{{ $buku->judul }}</td>

                                        <td>{{ $buku->kategori->nama_kategori }}</td>

                                        <td>
                                            @if($buku->gambar)
                                            <img src="{{ asset('storage/'.$buku->gambar) }}"
                                                width="70"
                                                height="90"
                                                style="object-fit:cover;">
                                            @else
                                            Tidak Ada
                                            @endif
                                        </td>

                                        <td>{{ $buku->stok }}</td>

                                        <td>
                                            @if($buku->stok > 0)

                                            <a href="{{ route('siswa.pinjam.form',$buku->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Pinjam
                                            </a>

                                            @else
                                            <span class="badge bg-danger">
                                                Habis
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

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