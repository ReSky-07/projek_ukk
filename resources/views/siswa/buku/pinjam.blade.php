@include('siswa.layouts.header')

<body class="sb-nav-fixed">
    @include('siswa.layouts.navbar')

    <div id="layoutSidenav">
        @include('siswa.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Pinjam Buku</h1>

                    <div class="card">
                        <div class="card-body">

                            <h4>{{ $buku->judul }}</h4>

                            @if($buku->gambar)
                            <img src="{{ asset('storage/'.$buku->gambar) }}"
                                width="120"
                                class="mb-3">
                            @endif

                            <p>Stok: {{ $buku->stok }}</p>

                            <form action="{{ route('siswa.pinjam.store') }}" method="POST">
                                @csrf

                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                                <button class="btn btn-primary">
                                    Pinjam Sekarang
                                </button>

                                <a href="{{ route('siswa.buku.index') }}"
                                    class="btn btn-secondary">
                                    Kembali
                                </a>

                            </form>

                        </div>
                    </div>

                </div>
            </main>

            @include('siswa.layouts.footer')
        </div>
    </div>
</body>

</html>