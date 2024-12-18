<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        .bg-gradient {
            background: linear-gradient(to right, #588A46, #68BE49);
        }

        .btn-custom {
            background-color: #588A46;
            color: white;
        }

        .btn-custom:hover {
            background-color: #68BE49;
            color: white;
        }

        .card-header-custom {
            background: linear-gradient(to right, #588A46, #68BE49);
            color: white;
        }

        .card-body-custom {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .card-custom {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .img-fluid-custom {
            max-height: 300px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Detail Produk</h1>

        <!-- Cek jika item ada -->
        @if($item)
            <!-- Card untuk menampilkan detail produk -->
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <h5 class="mb-0">{{ $item->nama }}</h5>
                </div>
                <div class="card-body card-body-custom">
                    <div class="row">
                        <!-- Kolom untuk gambar -->
                        <div class="col-md-4">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="img-fluid img-fluid-custom">
                            @else
                                <p>Gambar tidak tersedia.</p>
                            @endif
                        </div>

                        <!-- Kolom untuk detail produk -->
                        <div class="col-md-8">
                            <p><strong>Harga:</strong> Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                            <p><strong>Kategori:</strong> {{ $item->kategori_id ?? 'Tidak ada kategori' }}</p>

                            <h5 class="mt-4">Daftar Bahan:</h5>
                            <ul class="list-group mb-4">
                                @foreach($item->ingredients as $ingredient)
                                    <li class="list-group-item">
                                        {{ $ingredient->nama }} ({{ $ingredient->stok }} {{ $ingredient->satuan }})
                                    </li>
                                @endforeach
                            </ul>

                            <a href="{{ route('produk.index') }}" class="btn btn-custom">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p>Produk tidak ditemukan.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
