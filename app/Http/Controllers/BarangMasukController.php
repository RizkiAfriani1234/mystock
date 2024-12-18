<?php
namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Category;
use App\Models\Stock;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        // Menampilkan data barang masuk
        $stocks = Stock::all();
        return view('barangmasuk.index', compact('stocks'));
    }

    public function create()
    {
        // Menampilkan form untuk menambah barang masuk
        $ingredients = Ingredient::all();  // Mengambil data ingredient
        $categories = Category::all();  // Mengambil data kategori
        return view('barangmasuk.create', compact('ingredients', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required',
            'kategori_id' => 'required', // Mengganti category_id dengan kategori_id
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'satuan' => 'required|string',
        ]);

        Stock::create([
            'ingredient_id' => $validated['ingredient_id'],
            'kategori_id' => $validated['kategori_id'], // Menggunakan kategori_id
            'jumlah' => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
            'satuan' => $validated['satuan'],
        ]);

        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil ditambahkan');
    }


        public function edit($id)
    {
        // Mengambil data stock berdasarkan ID
        $stock = Stock::findOrFail($id);
        $ingredients = Ingredient::all();
        $categories = Category::all();

        return view('barangmasuk.edit', compact('stock', 'ingredients', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari form edit
        $validated = $request->validate([
            'ingredient_id' => 'required',
            'kategori_id' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'satuan' => 'required|string',
        ]);

        // Menemukan dan memperbarui data stock yang sesuai
        $stock = Stock::findOrFail($id);
        $stock->update([
            'ingredient_id' => $validated['ingredient_id'],
            'kategori_id' => $validated['kategori_id'],
            'jumlah' => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
            'satuan' => $validated['satuan'],
        ]);

        // Redirect ke halaman daftar barang masuk dengan pesan sukses
        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil diperbarui');
    }


    public function destroy($id)
    {
        // Menghapus data barang masuk
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil dihapus');
    }
}
