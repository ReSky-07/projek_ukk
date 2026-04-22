@include('admin.layouts.header')

<body class="sb-nav-fixed">
    @include('admin.layouts.navbar')

    <div id="layoutSidenav">
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Edit Buku</h1>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.buku.index') }}">Buku</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>

                    {{-- ERROR VALIDASI --}}
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
                            <i class="fas fa-edit me-1"></i>
                            Form Edit Buku
                        </div>

                        <div class="card-body">

                            <form action="{{ route('admin.buku.update',$buku->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Judul Buku</label>
                                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $buku->judul) }}">
                                </div>

                                <div class="mb3">
                                    <label class="form-label">Stok Buku</label>
                                    <input type="number" name="stok"
                                        value="{{ old('stok', $buku->stok) }}"
                                        class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="kategori_id" class="form-control">
                                        @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Gambar Buku</label>
                                    <input type="file" name="gambar" class="form-control">

                                    @if($buku->gambar)
                                    <img src="{{ asset('storage/'.$buku->gambar) }}" width="100" class="mt-2">
                                    @endif
                                </div>

                                <button class="btn btn-success">Update</button>
                                <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary">Kembali</a>

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