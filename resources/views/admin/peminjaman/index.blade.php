@include('admin.layouts.header')

<body class="sb-nav-fixed">
    @include('admin.layouts.navbar')

    <div id="layoutSidenav">
        @include('admin.layouts.sidebar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4">Data Peminjaman</h1>

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Siswa</th>
                                    <th>Buku</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>

                                @foreach($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->buku->judul }}</td>

                                    <td>
                                        {{ $row->status }}
                                    </td>

                                    <td>
                                        @if($row->status == 'menunggu_konfirmasi')

                                        <form action="{{ route('admin.konfirmasi',$row->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                Konfirmasi
                                            </button>
                                        </form>

                                        @else
                                        -
                                        @endif
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