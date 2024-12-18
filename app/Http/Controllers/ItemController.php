<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // Menampilkan semua item
    public function index()
    {
        $items = Item::all();
        return view('produk.index', compact('items'));
    }

    // Menampilkan form untuk membuat item baru
    public function create(Request $request)
    {
        // Mengambil kategori dari query parameter jika ada
        $category = $request->query('category', 'Tidak Ada');
        return view('produk.create', compact('category'));
    }

    // Menyimpan item baru dan ingredients
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'kode' => 'required|unique:items,kode|max:255',
            'nama' => 'required|max:255',
            'harga' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ingredients.*.kode' => 'required|max:255',
            'ingredients.*.nama' => 'required|max:255',
            'ingredients.*.stok' => 'required|integer|min:1',
            'ingredients.*.satuan' => 'required|max:255',
        ]);

        // Membuat item baru
        $item = Item::create([
            'kode' => $validated['kode'],
            'nama' => $validated['nama'],
            'harga' => $validated['harga'],
            'foto' => $request->hasFile('foto') 
                ? $request->file('foto')->store('item_images', 'public') 
                : null,
        ]);

        // Menambahkan ingredients ke dalam pivot table jika ada
        if (isset($validated['ingredients'])) {
            foreach ($validated['ingredients'] as $ingredient) {
                // Cek apakah ingredient sudah ada dalam database, jika tidak buat baru
                $ingredientModel = Ingredient::firstOrCreate(
                    ['kode' => $ingredient['kode']], // Cek berdasarkan kode ingredient
                    ['nama' => $ingredient['nama'], 'stok' => $ingredient['stok'], 'satuan' => $ingredient['satuan']]
                );

                // Menambahkan ingredient ke pivot table dengan jumlah dan satuan
                $item->ingredients()->attach($ingredientModel->id, [
                    'jumlah' => $ingredient['stok'], // Anda bisa menyesuaikan logika jumlah
                    'satuan' => $ingredient['satuan']
                ]);
            }
        }

        // Redirect ke halaman index produk dengan pesan sukses
        return redirect()->route('produks.index')->with('success', 'Produk dan bahan baku berhasil ditambahkan.');
    }

    // Menghapus item beserta foto jika ada
            public function destroy($id)
        {
            $item = Item::findOrFail($id);

            // Hapus relasi ingredients
            $item->ingredients()->detach();

            // Hapus foto dari storage jika ada
            if ($item->foto) {
                Storage::delete('public/item_images/' . $item->foto);
            }

            // Hapus item dari database
            $item->delete();

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('items.index')->with('success', 'Item berhasil dihapus.');
        }


    // Menampilkan detail item beserta ingredients
    public function show($id)
    {
        // Ambil data produk berdasarkan ID, termasuk ingredients
        $item = Item::with('ingredients')->find($id);

        // Cek apakah produk ditemukan
        if (!$item) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan.');
        }

        return view('produk.detail', compact('item'));
    }
}
