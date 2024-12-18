<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;         // Model Item untuk total barang
use App\Models\Stock;        // Model Stock untuk barang masuk
use App\Models\StockHistory; // Model StockHistory untuk barang keluar

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil data stok dari database beserta kategori dan ingredient
        $stocks = Stock::with(['ingredient', 'category'])->get();

        // Hitung total data barang menggunakan model Item
        $totalBarang = Item::count(); // Menghitung jumlah barang yang ada di model Item

        // Hitung total barang masuk menggunakan model Stock
        $totalBarangMasuk = Stock::sum('jumlah'); // Mengambil jumlah barang dari tabel Stock yang masuk

        // Hitung total barang keluar menggunakan model StockHistory yang berelasi dengan model Stock
        $totalBarangKeluar = StockHistory::sum('jumlah'); // Mengambil jumlah barang yang keluar berdasarkan StockHistory

        // Kirim data ke view
        return view('auth.dashboard', [
            'stocks' => $stocks,
            'totalBarang' => $totalBarang,
            'totalBarangMasuk' => $totalBarangMasuk,
            'totalBarangKeluar' => $totalBarangKeluar,
        ]);
    }

    /**
     * Update stok produk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStock(Request $request, $id)
    {
        $stock = Stock::find($id);
        $stock->jumlah = $request->input('stock');
        $stock->save();

        return response()->json(['success' => true]);
    }
}
