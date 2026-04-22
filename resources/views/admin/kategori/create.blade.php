@include('admin.layouts.header')

<body class="sb-nav-fixed">
    @include('admin.layouts.navbar')

    <div id="layoutSidenav">
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Tambah Kategori</h1>

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
                        <div class="card-body">

                            <form action="{{ route('admin.kategoris.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="nama_kategori" class="form-control">
                                </div>

                                <button class="btn btn-primary">Simpan</button>

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