<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Rincian Pembayaran</h1>

        <div class="card">
            <div class="card-header">
                <h3>Detail Transaksi</h3>
            </div>
            <div class="card-body">
                <p><strong>Item:</strong> {{ $transaction->item->nama }}</p>
                <p><strong>Jumlah:</strong> {{ $transaction->quantity }}</p>
                <p><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</p>
                <hr>
                <form>
                    <div class="mb-3">
                        <label for="tunai" class="form-label">Tunai</label>
                        <input type="number" id="tunai" class="form-control" placeholder="Masukkan jumlah tunai">
                    </div>
                    <div class="mb-3">
                        <label for="kembalian" class="form-label">Kembalian</label>
                        <input type="text" id="kembalian" class="form-control" readonly>
                    </div>
                    <button type="button" class="btn btn-primary w-100" onclick="selesai()">Selesai</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Ambil elemen HTML
        const tunaiInput = document.getElementById('tunai');
        const kembalianInput = document.getElementById('kembalian');

        // Ambil total harga dari PHP
        const totalHarga = {{ $transaction->total_harga }};

        // Hitung kembalian
        tunaiInput.addEventListener('input', () => {
            const tunai = parseFloat(tunaiInput.value) || 0;
            const kembalian = tunai - totalHarga;
            kembalianInput.value = kembalian > 0 ? kembalian.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }) : 'Rp 0';
        });

        // Fungsi untuk menyelesaikan transaksi
        function selesai() {
            alert('Transaksi Selesai!');
            window.location.href = '{{ route('transactions.index') }}';
        }
    </script>
</body>
</html>
