@include('admin.layouts.header')

<body class="sb-nav-fixed">
    @include('admin.layouts.navbar')

    <div id="layoutSidenav">
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Tambah Buku</h1>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.buku.index') }}">Buku</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>

                    {{-- ERROR VALIDASI --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card shadow">
                        <div class="card-header">
                            <i class="fas fa-book me-1"></i>
                            Form Tambah Buku
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- JUDUL --}}
                                <div class="mb-3">
                                    <label class="form-label">Judul Buku</label>
                                    <input
                                        type="text"
                                        name="judul"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        value="{{ old('judul') }}"
                                        placeholder="Masukkan judul buku">
                                </div>

                                {{-- STOK --}}
                                <div class="mb-3">
                                    <label class="form-label">Stok</label>
                                    <input
                                        type="number"
                                        name="stok"
                                        class="form-control @error('stok') is-invalid @enderror"
                                        value="{{ old('stok') }}"
                                        placeholder="Masukkan jumlah stok">
                                </div>

                                {{-- KATEGORI CHECKBOX --}}
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>

                                    <div class="row">
                                        @foreach($kategoris as $kategori)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input
                                                    type="checkbox"
                                                    name="kategori_id[]"
                                                    value="{{ $kategori->id }}"
                                                    class="form-check-input"
                                                    id="kategori{{ $kategori->id }}"
                                                    {{ in_array($kategori->id, old('kategori_id', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="kategori{{ $kategori->id }}">
                                                    {{ $kategori->nama_kategori }}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    @error('kategori_id')
                                    <small class="text-danger d-block mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- GAMBAR --}}
                                <div class="mb-3">
                                    <label class="form-label">Gambar Buku</label>
                                    <input
                                        type="file"
                                        name="gambar"
                                        class="form-control @error('gambar') is-invalid @enderror">
                                </div>

                                {{-- BUTTON --}}
                                <div class="mt-4">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Simpan
                                    </button>

                                    <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary">
                                        Kembali
                                    </a>
                                </div>

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