<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - My Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        .bg-gradient {
            background: linear-gradient(to right, #588A46, #68BE49);
        }

        .header {
            background: linear-gradient(to right, #588A46, #68BE49);
            color: white;
        }

        #background-card {
            border-radius: 15px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 1px solid #68BE49;
        }

        /* Image preview style */
        #fotoPreview {
            max-width: 200px;
            display: none;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Content -->
            <div class="col-md-10 p-4">
                <div class="header p-3 rounded mb-4">
                    <h2><i class="bi bi-basket3"></i> Tambah Produk</h2>
                </div>

                <!-- Tampilkan Kategori -->
                <div class="mb-4">
                    <h5>Kategori: <span class="badge bg-success" id="selectedCategory"></span></h5>
                </div>

                <!-- Form Tambah Produk -->
                <form action="{{ route('produks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="kategori" name="kategori" value="{{ $category }}">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Produk</label>
                        <input type="text" name="kode" id="kode"
                            class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode') }}"
                            required>
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Produk -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>

                    <!-- Foto -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*"
                            onchange="previewImage(event)">
                    </div>

                    <!-- Preview Foto -->
                    <img id="fotoPreview" class="product-image" alt="Preview Produk">

                    <!-- Section: Bahan Baku -->
                    <h4 class="mt-4">Bahan Baku</h4>
                    <table class="table table-bordered" id="ingredient_table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Ingredient</th>
                                <th>Nama Ingredient</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><input type="text" name="ingredients[0][kode]" class="form-control" required>
                                </td>
                                <td><input type="text" name="ingredients[0][nama]" class="form-control" required>
                                </td>
                                <td><input type="number" name="ingredients[0][stok]" class="form-control" required>
                                </td>
                                <td>
                                    <select name="ingredients[0][satuan]" class="form-control">
                                        <option value="gram">gram</option>
                                        <option value="ml">ml</option>
                                        <option value="pcs">pcs</option>
                                    </select>
                                </td>
                                <td><button type="button" class="btn btn-danger remove-tr">Hapus</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Tambah Bahan & Simpan -->
                    <div class="row mb-3">
                        <div class="col d-flex justify-content-between">
                            <button type="button" class="btn btn-success" id="addIngredient">Tambah Bahan</button>
                            <button type="submit" class="btn btn-primary">Simpan Produk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Ambil kategori dari URL
        const urlParams = new URLSearchParams(window.location.search);
        const category = urlParams.get('category');

        // Tampilkan kategori yang dipilih
        document.getElementById('selectedCategory').textContent = category || 'Tidak Ada';

        // Isi input tersembunyi dengan kategori (seandainya dibutuhkan di backend)
        document.getElementById('kategori').value = category || '';

        // Preview Foto
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('fotoPreview');
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        // Add Ingredient Row
        document.getElementById('addIngredient').addEventListener('click', function() {
            const table = document.getElementById('ingredient_table').getElementsByTagName('tbody')[0];
            const rowCount = table.rows.length; // Ambil jumlah baris saat ini
            const newRow = table.insertRow(rowCount); // Masukkan baris baru pada posisi terakhir

            newRow.innerHTML = `
                <td>${rowCount + 1}</td>
                <td><input type="text" name="ingredients[${rowCount}][kode]" class="form-control" required></td>
                <td><input type="text" name="ingredients[${rowCount}][nama]" class="form-control" required></td>
                <td><input type="number" name="ingredients[${rowCount}][stok]" class="form-control" required></td>
                <td>
                    <select name="ingredients[${rowCount}][satuan]" class="form-control">
                        <option value="gram">gram</option>
                        <option value="ml">ml</option>
                        <option value="pcs">pcs</option>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger remove-tr">Hapus</button></td>
            `;
        });

        // Remove Ingredient Row
        document.getElementById('ingredient_table').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-tr')) {
                const row = e.target.closest('tr');
                row.remove();

                // Update numbering after removal
                const rows = document.getElementById('ingredient_table').getElementsByTagName('tbody')[0].rows;
                for (let i = 0; i < rows.length; i++) {
                    rows[i].cells[0].textContent = i + 1; // Update number in the first column
                }
            }
        });
    </script>
</body>

</html>
