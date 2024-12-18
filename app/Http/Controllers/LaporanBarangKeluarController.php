<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockHistory;

class LaporanBarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $stockHistories = [];
        $tanggal = $request->tanggal ?? null;

        if ($tanggal) {
            $stockHistories = StockHistory::with('stock')
                ->whereDate('tanggal', $tanggal)
                ->get();
        }

        return view('laporankeluar.index', compact('stockHistories', 'tanggal'));
    }
}
