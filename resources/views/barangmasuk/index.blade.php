<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang Masuk - My Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        .bg-gradient {
            background: linear-gradient(to right, #588A46, #68BE49);
        }

        .sidebar {
            font-size: 14px;
            border-right: 2px solid #ddd;
            padding-right: 10px;
        }

        .sidebar .nav-link {
            color: #305822;
        }

        .sidebar .nav-link i {
            color: #305822;
            margin-right: 8px;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(48, 88, 34, 0.1);
        }

        .header {
            background: linear-gradient(to right, #588A46, #68BE49);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .card-header {
            background: linear-gradient(to right, #588A46, #68BE49);
        }

        .table-responsive {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-gradient {
            background: linear-gradient(to right, #588A46, #68BE49);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
        }

        .btn-gradient:hover {
            background: linear-gradient(to right, #68BE49, #588A46);
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar vh-100 p-3">
                <div class="text-center mb-4">
                    <a href="/profile">
                        <img src="{{ asset('img/logo3.png') }}" alt="Logo" class="img-fluid rounded-circle mb-2" style="width: 100px;">
                    </a>
                    <h4>My Stock</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('auth.dashboard') }}" class="nav-link">
                            <i class="bi bi-house-door-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <span class="nav-link">
                            <i class="bi bi-box2"></i> Master
                        </span>
                        <ul class="list-unstyled ps-3">
                            <li><a href="{{ route('transactions.index') }}" class="nav-link">
                                <i class="bi bi-cash"></i> Kasir
                            </a>
                            <li><a href="{{ route('produks.index') }}" class="nav-link"><i class="bi bi-basket3"></i>
                                    Barang</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mb-2">
                        <span class="nav-link">
                            <i class="bi bi-clipboard"></i> Inventori
                        </span>
                        <ul class="list-unstyled ps-3">
                            <li class="nav-item mb-2">
                                <a href="{{ route('stocks.index') }}" class="nav-link">
                                    <i class="bi bi-archive"></i> Stok
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{ route('barangmasuk.index') }}" class="nav-link">
                                    <i class="bi bi-arrow-down-square"></i> Barang Masuk
                                </a>
                            </li>
                            <li><span class="nav-link"><i class="bi bi-arrow-up-square"></i> Barang Keluar</span></li>
                        </ul>
                    </li>
                    <li class="nav-item mb-2">
                        <span class="nav-link">
                            <i class="bi bi-journal-text"></i> Laporan
                        </span>
                        <ul class="list-unstyled ps-3">
                            <li><a href="{{ route('laporanmasuk.index') }}" class="nav-link"><i class="bi bi-file-earmark-arrow-down"></i> Laporan Barang Masuk</a></li>
                            <li><a href="#" class="nav-link"><i class="bi bi-file-earmark-arrow-up"></i> Laporan Barang Keluar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-gear-fill"></i> Pengaturan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <div class="header mb-4">
                    <h2><i class="bi bi-arrow-down-square"></i> Data Barang Masuk</h2>
                </div>
                <a href="{{ route('barangmasuk.create') }}" class="btn btn-gradient mb-3">
                    <i class="bi bi-plus-circle"></i> Tambah Barang Masuk
                </a>

                <!-- Form untuk memilih tanggal laporan -->
                <form action="{{ route('laporanmasuk.index') }}" method="GET" class="mb-3">
                    <label for="tanggal">Pilih Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                    <button type="submit" class="btn btn-gradient ml-2">
                        <i class="bi bi-file-earmark-arrow-down"></i> Buat Laporan
                    </button>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>No</th>
                                <th>Kode Ingredient</th>
                                <th>Nama Ingredient</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $stock->ingredient->kode }}</td>
                                    <td>{{ $stock->ingredient->nama }}</td>
                                    <td>{{ $stock->category->nama }}</td>
                                    <td>{{ $stock->jumlah }}</td>
                                    <td>{{ $stock->satuan }}</td>
                                    <td>{{ $stock->tanggal }}</td>
                                    <td>
                                        <a href="{{ route('barangmasuk.edit', $stock->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('barangmasuk.destroy', $stock->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
