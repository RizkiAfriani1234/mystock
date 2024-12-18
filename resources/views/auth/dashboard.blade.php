<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - My Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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

        .card {
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card .card-body {
            padding: 20px;
            
        }

        .card i {
            font-size: 40px;
            color: #4CAF50;
        }

        .card .card-title {
            font-size: 20px;
            color: #333;
        }

        .card .card-text {
            font-size: 16px;
            color: #666;
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
             <div class="col-md-2 sidebar vh-100 p-3">
                <div class="text-center mb-4">
                        <img src="{{ asset('img/logo3.png') }}" alt="Logo" class="img-fluid rounded-circle mb-2"
                            style="width: 100px;">
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
                            <li class="nav-item mb-2">
                                <a href="{{ route('barangkeluar.index') }}" class="nav-link">
                                    <i class="bi bi-arrow-up-square"></i> Barang Keluar
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item mb-2">
                        <span class="nav-link">
                            <i class="bi bi-journal-text"></i> Laporan
                        </span>
                        <ul class="list-unstyled ps-3">
                            <li>
                                <a href="{{ route('laporanmasuk.index') }}" class="nav-link">
                                    <i class="bi bi-file-earmark-arrow-down"></i> Laporan Barang Masuk
                                </a>
                            </li>
                            <li><span class="nav-link"><i class="bi bi-file-earmark-arrow-up"></i> Laporan Barang
                                    Keluar</span></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                    <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link text-danger border-0 bg-transparent">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </button>
                    </form>
                </li>
                </ul>
            </div>

            <!-- Content -->
            <div class="col-md-10 p-4">
                <div class="header p-3 rounded mb-4">
                    <h2><i class="bi bi-house-door-fill"></i> Dashboard</h2>

                    <div class="text-center mb-4">
                        <a href="{{ route('profile.show') }}" class="d-block">
                            <img src="{{ asset('img/logo3.png') }}" alt="Profil" class="img-fluid rounded-circle mb-2"
                                style="width: 80px; height: 80px; object-fit: cover;">
                        </a>
                        <h5>{{ Auth::user()->name }}</h5>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="row mb-4">
                    <!-- Data Barang Card -->
                    <div class="col-md-4">
                        <div class="card text-center shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-box display-6"></i>
                                <h5 class="card-title">Data Barang</h5>
                                <p class="card-text">{{ $totalBarang }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Barang Masuk Card -->
                    <div class="col-md-4">
                        <div class="card text-center shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-arrow-down-square display-6"></i>
                                <h5 class="card-title">Data Barang Masuk</h5>
                                <p class="card-text">{{ $totalBarangMasuk }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Barang Keluar Card -->
                    <div class="col-md-4">
                        <div class="card text-center shadow-sm">
                            <div class="card-body">
                                <i class="bi bi-arrow-up-square display-6"></i>
                                <h5 class="card-title">Data Barang Keluar</h5>
                                <p class="card-text">{{ $totalBarangKeluar }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Table: Stocks -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Daftar Stok</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Satuan</th>
                                    <th>Stok Saat Ini</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                <tr id="stock-{{ $stock->id }}">
                                    <td>{{ $stock->id }}</td>
                                    <td>{{ $stock->ingredient->kode ?? '-' }}</td>
                                    <td>{{ $stock->ingredient->nama ?? '-' }}</td>
                                    <td>{{ $stock->category->nama ?? '-' }}</td>
                                    <td>{{ $stock->tanggal }}</td>
                                    <td>{{ $stock->satuan }}</td>
                                    <td id="stok-{{ $stock->id }}" class="
                                        {{ $stock->jumlah > 100 ? 'stok-berlebih' : ($stock->jumlah >= 10 && $stock->jumlah <= 100 ? 'stok-medium' : 'stok-kritis') }}">
                                        {{ $stock->jumlah }}
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Contoh penggunaan jQuery untuk memperbarui stok saat ada perubahan
    function updateStock(stockId, newStock) {
        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: '/update-stock/' + stockId, // ganti dengan URL API yang sesuai
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // pastikan CSRF token ada
                stock: newStock
            },
            success: function(response) {
                // Perbarui data pada tampilan
                $('#stok-' + stockId).text(newStock);
                if (newStock <= 10) {
                    $('#stok-' + stockId).removeClass('stok-berlebih').addClass('stok-kritis');
                } else {
                    $('#stok-' + stockId).removeClass('stok-kritis').addClass('stok-berlebih');
                }
            },
            error: function() {
                alert('Terjadi kesalahan dalam memperbarui stok');
            }
        });
    }
</script>
</body>

</html>
