@include('siswa.layouts.header')

<body class="sb-nav-fixed">
    @include('siswa.layouts.navbar')

    <div id="layoutSidenav">
        @include('siswa.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Daftar Buku</h1>
                    <div class="card mb-4">
                        <div class="card-body">

                            <form method="GET" action="{{ route('siswa.buku.index') }}">
                                <div class="row">

                                    <div class="col-md-5">
                                        <input type="text"
                                            name="judul"
                                            class="form-control"
                                            placeholder="Cari judul buku..."
                                            value="{{ request('judul') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <select name="kategori_id" class="form-control">
                                            <option value="">Semua Kategori</option>

                                            @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <button class="btn btn-primary">
                                            Cari
                                        </button>

                                        <a href="{{ route('siswa.buku.index') }}"
                                            class="btn btn-secondary">
                                            Reset
                                        </a>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
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