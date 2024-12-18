<?php
namespace App\Http\Controllers;

use App\Models\StockHistory;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function index()
    {
        $stockHistories = StockHistory::with(['stock', 'stock.category'])
            ->select('id', 'stock_id', 'transaction_detail_id', 'nama_bahan', 'banyak_bahan', 'tanggal', 'satuan', 'jumlah', 'unit')
            ->get();

        return view('barangkeluar.index', compact('stockHistories'));
    }
}
