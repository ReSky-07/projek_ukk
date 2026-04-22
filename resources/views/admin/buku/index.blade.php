@include('admin.layouts.header')

<body class="sb-nav-fixed">
    @include('admin.layouts.navbar')

    <div id="layoutSidenav">
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Data Buku</h1>

                    <a href="{{ route('admin.buku.create') }}" class="btn btn-primary mb-3">
                        Tambah Buku
                    </a>

                    <div class="card">
                        <div class="card-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Stok</th>
                                    <th>Kategori</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>

                                @foreach($bukus as $buku)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->stok }}</td>
                                    <td>{{ $buku->kategori->nama_kategori }}</td>
                                    <td>
                                        @if($buku->gambar)
                                        <img src="{{ asset('storage/'.$buku->gambar) }}" width="70">
                                        @else
                                        Tidak ada gambar
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.buku.edit', $buku->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
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