<?php
namespace App\Http\Controllers;

use App\Models\StockHistory;
use App\Models\Ingredient;
use App\Models\Category;
use Illuminate\Http\Request;

class StockHistoryController extends Controller
{
    // Menampilkan daftar barang keluar
    public function index(Request $request)
    {
        $categories = Category::all(); // Ambil semua kategori untuk filter

        // Ambil data stock history, relasikan dengan ingredient dan kategori
        $stockHistories = StockHistory::with(['ingredient', 'category'])
            ->when($request->category_id, function ($query) use ($request) {
                return $query->where('kategori_id', $request->category_id);
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('barangkeluar.index', compact('categories', 'stockHistories'));
    }

    // Menambah data barang keluar
        public function store(Request $request)
    {
        $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id', // Validasi item harus ada
            'kategori_id' => 'required|exists:categories,id', // Validasi kategori harus ada
            'jumlah' => 'required|numeric|min:1', // Validasi jumlah barang
            'unit' => 'required|string', // Validasi unit
            'tanggal' => 'required|date', // Validasi tanggal
            'keterangan' => 'nullable|string', // Keterangan opsional
        ]);

        // Mengambil ingredient berdasarkan ingredient_id yang dipilih
        $ingredient = Ingredient::findOrFail($request->ingredient_id);
        $category = Category::findOrFail($request->kategori_id);

        // Mengurangi stok ingredient sesuai dengan jumlah barang yang keluar
        $ingredient->stok -= $request->jumlah;
        $ingredient->save();

        // Membuat entri baru untuk barang keluar pada stock_histories
        StockHistory::create([
            'ingredient_id' => $request->ingredient_id,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'unit' => $request->unit,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'message' => 'Barang keluar berhasil dicatat!',
        ]);
    }


    // Menampilkan detail history barang keluar
    public function show($id)
    {
        $stockHistory = StockHistory::with(['ingredient', 'category'])->findOrFail($id);
        return response()->json($stockHistory);
    }

    // Mengupdate data history barang keluar
    public function update(Request $request, $id)
    {
        $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'kategori_id' => 'required|exists:categories,id',
            'jumlah' => 'required|numeric|min:1',
            'unit' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $stockHistory = StockHistory::findOrFail($id);
        $stockHistory->update($request->all());

        // Pastikan stok ingredient diupdate sesuai dengan perubahan jumlah barang keluar
        $ingredient = Ingredient::findOrFail($stockHistory->ingredient_id);
        $ingredient->stok -= ($request->jumlah - $stockHistory->jumlah); // Update stok berdasarkan perubahan jumlah
        $ingredient->save();

        return response()->json([
            'message' => 'History stok berhasil diperbarui!',
            'data' => $stockHistory
        ]);
    }

    // Menghapus data barang keluar
    public function destroy($id)
    {
        $stockHistory = StockHistory::findOrFail($id);

        // Kembalikan stok ingredient yang dikeluarkan
        $ingredient = Ingredient::findOrFail($stockHistory->ingredient_id);
        $ingredient->stok += $stockHistory->jumlah;
        $ingredient->save();

        $stockHistory->delete();

        return response()->json([
            'message' => 'History stok berhasil dihapus!'
        ]);
    }
}
