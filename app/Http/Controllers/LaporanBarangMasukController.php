<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use Carbon\Carbon;
use PDF;

class LaporanBarangMasukController extends Controller
{
    /**
     * Tampilkan daftar laporan barang masuk per tanggal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil laporan barang masuk dengan eager load relasi Ingredients dan Category
        $laporanPerTanggal = Stock::with(['ingredient', 'category'])
            ->selectRaw('tanggal, COUNT(*) as total_items')
            ->groupBy('tanggal')
            ->orderByDesc('tanggal')
            ->get();

        return view('laporanmasuk.index', compact('laporanPerTanggal'));
    }

    /**
     * Tampilkan detail laporan barang masuk berdasarkan tanggal.
     *
     * @param  string  $tanggal
     * @return \Illuminate\Http\Response
     */
    public function detail($tanggal)
    {
        // Validasi format tanggal
        if (!Carbon::hasFormat($tanggal, 'Y-m-d')) {
            abort(404, 'Tanggal tidak valid.');
        }

        // Ambil data barang masuk pada tanggal tertentu
        $barangMasuk = Stock::with(['ingredient', 'category'])
            ->whereDate('tanggal', $tanggal)
            ->get()
            ->map(function ($item) {
                return [
                    'stok_awal' => $item->stok_awal,
                    'barang_masuk' => $item->banyak_barang ?? 0,
                    'stok_akhir' => $item->stok_akhir,
                    'tanggal' => $item->tanggal,
                    'kode_barang' => $item->ingredient->kode_barang ?? 'N/A',
                    'nama_barang' => $item->ingredient->nama_barang ?? 'N/A',
                    'kategori' => $item->category->nama ?? 'N/A',
                    'satuan' => $item->ingredient->satuan ?? 'N/A',
                ];
            });

        return view('laporanmasuk.detail', [
            'tanggal' => $tanggal,
            'barangMasuk' => $barangMasuk,
        ]);
    }

    /**
     * Cetak laporan barang masuk dalam format PDF.
     *
     * @param  string  $tanggal
     * @return \Illuminate\Http\Response
     */
    public function cetakPDF($tanggal)
    {
        // Validasi format tanggal
        if (!Carbon::hasFormat($tanggal, 'Y-m-d')) {
            abort(404, 'Tanggal tidak valid.');
        }

        // Ambil data barang masuk berdasarkan tanggal
        $barangMasuk = Stock::with(['ingredient', 'category'])
            ->whereDate('tanggal', $tanggal)
            ->get()
            ->map(function ($item) {
                return [
                    'kode_barang' => $item->ingredient->kode_barang ?? 'N/A',
                    'nama_barang' => $item->ingredient->nama_barang ?? 'N/A',
                    'kategori' => $item->category->nama ?? 'N/A',
                    'barang_masuk' => $item->banyak_barang ?? 0,
                    'satuan' => $item->ingredient->satuan ?? 'N/A',
                    'tanggal' => $item->tanggal,
                ];
            });

        // Generate PDF menggunakan view 'laporan.cetak_barangmasuk'
        $pdf = PDF::loadView('laporanmasuk.cetak_barangmasuk', [
            'barangMasuk' => $barangMasuk,
            'tanggal' => $tanggal,
        ]);

        // Download file PDF
        return $pdf->download('laporan-barang-masuk-' . Carbon::parse($tanggal)->format('d-m-Y') . '.pdf');
    }
}
