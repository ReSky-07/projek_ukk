@include('siswa.layouts.header')

<body class="sb-nav-fixed">
    @include('siswa.layouts.navbar')
    <div id="layoutSidenav">
        @include('siswa.layouts.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">

                        {{-- Jumlah Buku --}}
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $bukuCount }}</h5>
                                    <p class="mb-0">Jumlah Buku</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('siswa.buku.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-users"></i></div>
                                </div>
                            </div>
                        </div>

                        {{-- Jumlah Buku Dipinjam --}}
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $dipinjam }}</h5>
                                    <p class="mb-0">Jumlah Dipinjam</p> <!-- jumlah buku yang dipinjam -->
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('siswa.peminjaman.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-toolbox"></i></div>
                                </div>
                            </div>
                        </div>

                        {{-- Jumlah Buku Menunggu Dipinjam --}}
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $menunggu }}</h5>
                                    <p class="mb-0">Jumlah Menunggu</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('siswa.peminjaman.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-tags"></i></div>
                                </div>
                            </div>
                        </div>

                        {{-- Jumlah Dikembalikan --}}
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <h5>{{ $dikembalikan }}</h5>
                                    <p class="mb-0">Jumlah Dikembalikan</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('siswa.peminjaman.index') }}">
                                        Lihat Data
                                    </a>
                                    <div class="small text-white"><i class="fas fa-clipboard-list"></i></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card mb-4">
                    </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('siswa.layouts.footer')
</body>

</html>