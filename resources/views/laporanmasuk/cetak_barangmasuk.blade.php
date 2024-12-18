<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }

        table th {
            background-color: #588A46;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Barang Masuk</h2>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Barang Masuk</th>
                <th>Satuan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangMasuk as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['kode_barang'] }}</td>
                    <td>{{ $item['nama_barang'] }}</td>
                    <td>{{ $item['kategori'] }}</td>
                    <td>{{ $item['barang_masuk'] }}</td>
                    <td>{{ $item['satuan'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d F Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
