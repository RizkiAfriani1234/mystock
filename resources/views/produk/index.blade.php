<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - My Stock</title>
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

        .card img {
            max-height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-price {
            font-size: 1.1rem;
            color: #68BE49;
        }

        .add-item-btn {
            margin-top: 20px;
        }

        .add-data-card {
            width: 200px;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            border: 2px solid #305822;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .add-data-card:hover {
            transform: scale(1.05);
        }

        .add-data-card i {
            font-size: 40px;
            color: #305822;
        }

        .add-data-card span {
            font-size: 16px;
            font-weight: bold;
            color: #305822;
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
                        <img src="{{ asset('img/logo3.png') }}" alt="Logo" class="img-fluid rounded-circle mb-2"
                            style="width: 100px;">
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
                <div class="header p-3 rounded mb-4">
                    <h2><i class="bi bi-basket3"></i> Daftar Produk</h2>
                </div>

                <!-- Combo Box for Category Selection -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="categorySelect" class="form-label">Pilih Kategori:</label>
                        <select id="categorySelect" class="form-select">
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                    </div>
                </div>

                <!-- Add Data Card -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <a href="#" id="addDataLink" class="add-data-card">
                            <i class="bi bi-plus-lg"></i>
                            <span>Data</span>
                        </a>
                    </div>
                </div>

                <!-- Card Products -->
                <div class="row">
                    @foreach ($items as $item)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <!-- Menampilkan gambar -->
                                <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top"
                                    alt="{{ $item->nama }}"
                                    onerror="this.onerror=null;this.src='{{ asset('img/default-product.jpg') }}';">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nama }}</h5>
                                    <p class="card-price">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                                    <!-- Form untuk menghapus item -->
                                    <form  action="{{ route('items.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                         <!-- Tombol untuk menuju halaman detail -->
                                         <a href="{{ route('produk.show', $item->id) }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-box-arrow-up-right"></i>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS & Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        document.getElementById('addDataLink').addEventListener('click', function(e) {
            e.preventDefault();
            const selectedCategory = document.getElementById('categorySelect').value;
            window.location.href = `{{ route('produks.create') }}?category=${selectedCategory}`;
        });
    </script>
</body>

</html>
