<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>

    <style>
        body {
            font-family: sans-serif;
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            background: #f2f2f2;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="title">LAPORAN PEMINJAMAN BUKU</div>

    <div class="info">
        <p>Dicetak oleh : {{ $admin->name }}</p>
        <p>Tanggal : {{ $tanggal->format('d-m-Y H:i') }}</p>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Batas Kembali</th>
            <th>Status</th>
        </tr>

        @foreach($data as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->user->name }}</td>
            <td>{{ $row->buku->judul }}</td>
            <td>{{ $row->tanggal_pinjam }}</td>
            <td>{{ $row->tanggal_kembali }}</td>
            <td>{{ ucfirst(str_replace('_', ' ', $row->status)) }}</td>
        </tr>
        @endforeach

    </table>

</body>

</html>