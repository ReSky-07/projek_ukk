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
                            <div class="row">
                                @foreach($bukus as $buku)
                                <div class="col-md-3 mb-4">
                                    <div class="card h-100 shadow-sm">

                                        @if($buku->gambar)
                                        <img src="{{ asset('storage/'.$buku->gambar) }}"
                                            class="card-img-top"
                                            style="height:200px; object-fit:cover;">
                                        @else
                                        <div class="d-flex align-items-center justify-content-center bg-light" style="height:200px;">
                                            Tidak Ada Gambar
                                        </div>
                                        @endif

                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $buku->judul }}</h5>
                                            <p class="card-text mb-1">
                                                <strong>Kategori:</strong> {{ $buku->kategori->nama_kategori }}
                                            </p>
                                            <p class="card-text mb-2">
                                                <strong>Stok:</strong> {{ $buku->stok }}
                                            </p>

                                            <div class="mt-auto">
                                                @if($buku->stok > 0)
                                                <a href="{{ route('siswa.pinjam.form',$buku->id) }}"
                                                    class="btn btn-primary w-100">
                                                    Pinjam
                                                </a>
                                                @else
                                                <span class="badge bg-danger w-100 d-block text-center">
                                                    Habis
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            </main>

            @include('siswa.layouts.footer')
        </div>
    </div>
</body>

</html>