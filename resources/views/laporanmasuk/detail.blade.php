<!-- Detail Laporan Barang Masuk -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Barang Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background: linear-gradient(to right, #588A46, #68BE49);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .table-container {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .table th {
            background-color: #588A46;
            color: white;
        }

        .table th, .table td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="header text-center">
            <h2>Detail Laporan Barang Masuk</h2>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</p>
        </div>

        <div class="table-container">
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah Masuk</th>
                        <th>Satuan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangMasuk as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kategori->nama ?? '-' }}</td>
                            <td>{{ $item->banyak_barang }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data barang masuk untuk tanggal ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('laporan.barangmasuk.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Laporan
            </a>
            <a href="{{ route('laporan.barangmasuk.cetak', ['tanggal' => $tanggal]) }}" class="btn btn-success">
                <i class="bi bi-printer"></i> Cetak PDF
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
