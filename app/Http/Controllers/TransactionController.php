<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Item;
use App\Models\Stock;
use App\Models\StockHistory;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $transactions = Transaction::with('item')->get();

        return view('kasir.index', compact('items', 'transactions'));
    }

    public function store(Request $request)
    {
        $items = json_decode($request->input('items'), true); // Ambil data produk yang dipilih

        \DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'total' => collect($items)->sum(fn($item) => $item['price'] * $item['quantity']),
            ]);

            foreach ($items as $itemData) {
                $item = Item::findOrFail($itemData['id']);
                $ingredient = $item->ingredient; // Mendapatkan ingredient terkait dengan item
                $stock = Stock::where('ingredient_id', $ingredient->id)->first();

                if (!$stock || $stock->jumlah < $itemData['quantity']) {
                    throw new \Exception("Stok untuk produk '{$item->nama}' tidak mencukupi.");
                }

                // Kurangi stok
                $stock->decrement('jumlah', $itemData['quantity']);

                // Simpan detail transaksi
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $item->id,
                    'quantity' => $itemData['quantity'],
                    'price' => $itemData['price'],
                    'total_price' => $itemData['price'] * $itemData['quantity'],
                ]);

                // Simpan riwayat stok
                StockHistory::create([
                    'ingredient_id' => $ingredient->id,
                    'kategori_id' => null,
                    'jumlah' => $itemData['quantity'],
                    'unit' => 'pcs', // Sesuaikan dengan unit Anda
                    'tanggal' => now(),
                ]);
            }

            \DB::commit();

            return redirect()->back()->with('message', 'Transaksi berhasil dilakukan!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $transaction = Transaction::findOrFail($id);
        $item = Item::findOrFail($request->item_id);
        $ingredient = $item->ingredient;
        $stock = Stock::where('ingredient_id', $ingredient->id)->first();

        if (!$stock) {
            return response()->json(['message' => 'Stok tidak ditemukan!'], 404);
        }

        $oldQuantity = $transaction->quantity;
        $newQuantity = $request->quantity;
        $difference = $newQuantity - $oldQuantity;

        if ($difference > 0 && $stock->jumlah < $difference) {
            return response()->json(['message' => 'Stok tidak mencukupi!'], 400);
        }

        $transaction->update([
            'item_id' => $item->id,
            'quantity' => $newQuantity,
            'total_harga' => $item->harga * $newQuantity,
        ]);

        $stock->decrement('jumlah', $difference);
        $stock->save();

        return response()->json(['message' => 'Transaksi berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        foreach ($transaction->details as $detail) {
            $stock = Stock::where('ingredient_id', $detail->item->ingredient_id)->first();
            if ($stock) {
                $stock->increment('jumlah', $detail->quantity);
            }
        }

        $transaction->details()->delete();
        $transaction->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus!']);
    }

    public function summary()
    {
        $transactions = Transaction::latest()->get();

        return view('summary', compact('transactions'));
    }
}
