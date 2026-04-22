@include('admin.layouts.header')

<body class="sb-nav-fixed">
    @include('admin.layouts.navbar')

    <div id="layoutSidenav">
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Pinjam Buku</h1>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('siswa.buku.index') }}">Buku</a></li>
                        <li class="breadcrumb-item active">Pinjam</li>
                    </ol>

                    {{-- ALERT --}}
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-book me-1"></i>
                            Form Peminjaman
                        </div>

                        <div class="card-body">

                            <form action="{{ route('siswa.pinjam.store') }}" method="POST">
                                @csrf

                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                                <div class="mb-3">
                                    <label class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" value="{{ $buku->judul }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Stok Tersedia</label>
                                    <input type="text" class="form-control" value="{{ $buku->stok }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jumlah Pinjam</label>
                                    <input type="number" name="jumlah" class="form-control" min="1" value="{{ old('jumlah') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pinjam</label>
                                    <input type="date" name="tanggal_pinjam" class="form-control" value="{{ old('tanggal_pinjam') }}">
                                </div>

                                <button class="btn btn-primary">Pinjam</button>
                                <a href="{{ route('siswa.buku.index') }}" class="btn btn-secondary">Kembali</a>

                            </form>

                        </div>
                    </div>

                </div>
            </main>

            @include('admin.layouts.footer')
        </div>
    </div>
</body>

</html>