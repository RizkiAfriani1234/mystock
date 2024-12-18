<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - My Stock</title>
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

        .stok-berlebih {
            color: green !important;
            font-weight: bold;
        }

        .stok-kritis {
            color: red !important;
            font-weight: bold;
        }

        .stok-medium {
            color: orange !important;  /* Menambahkan warna kuning */
            font-weight: bold; 
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
                            <li><span class="{{ route('laporanmasuk.index') }}"><i class="bi bi-file-earmark-arrow-down"></i> Laporan Barang
                                    Masuk</span></li>
                            <li><span class="nav-link"><i class="bi bi-file-earmark-arrow-up"></i> Laporan Barang
                                    Keluar</span></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="bi bi-gear-fill"></i> Pengaturan
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Content -->
            <div class="col-md-10 p-4">
                <!-- Header -->
                <div class="header p-3 rounded mb-4">
                    <h2><i class="bi bi-box"></i> Stock</h2>
                </div>

                <!-- Tabel Stok -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Daftar Stok</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode</th> <!-- Kolom Kode Baru -->
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Satuan</th>
                                    <th>Stok Awal</th>
                                    <th>Stok Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                    <tr>
                                        <td>{{ $stock->id }}</td>
                                        <td>{{ $stock->ingredient->kode ?? '-' }}</td>
                                        <td>{{ $stock->ingredient->nama ?? '-' }}</td> <!-- Nama Barang -->
                                        <td>{{ $stock->category->nama ?? '-' }}</td> <!-- Kategori -->
                                        <td>{{ $stock->tanggal }}</td>
                                        <td>{{ $stock->satuan }}</td>
                                        <td>{{ $stock->jumlah }}</td>
                                        <td id="stok-{{ $stock->id }}" class="
                                            {{ $stock->jumlah > 100 ? 'stok-berlebih' : ($stock->jumlah >= 10 && $stock->jumlah <= 100 ? 'stok-medium' : 'stok-kritis') }}"> 
                                            {{ $stock->stok_akhir }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $stocks->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>