@include('siswa.layouts.header')

<!-- SELECT2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Perbaikan tampilan select2 */
    .select2-container .select2-selection--multiple {
        min-height: 38px;
        padding: 4px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #0d6efd;
        border: none;
        color: white;
        padding: 3px 8px;
        margin-top: 4px;
    }
</style>

<body class="sb-nav-fixed">
    @include('siswa.layouts.navbar')

    <div id="layoutSidenav">
        @include('siswa.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Daftar Buku</h1>

                    <!-- FILTER -->
                    <div class="card mb-4">
                        <div class="card-body">

                            <form method="GET" action="{{ route('siswa.buku.index') }}">
                                <div class="row">

                                    <div class="col-md-5">
                                        <label class="form-label">Cari Judul</label>
                                        <input type="text"
                                            name="judul"
                                            class="form-control"
                                            placeholder="Cari judul buku..."
                                            value="{{ request('judul') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Filter Kategori</label>

                                        <select name="kategori_id[]" class="form-control select2" multiple>
                                            @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ collect(request('kategori_id', []))->contains($kategori->id) ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 d-flex align-items-end">
                                        <div class="w-100">
                                            <button class="btn btn-primary w-100 mb-2">
                                                Cari
                                            </button>

                                            <a href="{{ route('siswa.buku.index') }}"
                                                class="btn btn-secondary w-100">
                                                Reset
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                    <!-- ALERT -->
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

                    <!-- LIST BUKU -->
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
                                                <strong>Kategori:</strong><br>
                                                @foreach($buku->kategoris as $kategori)
                                                <span class="badge bg-primary">{{ $kategori->nama_kategori }}</span>
                                                @endforeach
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

    <!-- jQuery (WAJIB PALING ATAS) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- INIT SELECT2 -->
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih kategori",
                allowClear: true,
                width: '100%',
                closeOnSelect: false
            });
        });
    </script>

</body>

</html>