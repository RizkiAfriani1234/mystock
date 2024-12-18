<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockHistoryController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanBarangMasukController;
use App\Http\Controllers\LaporanBarangKeluarController;

// Halaman Welcome
Route::get('/', function () {
    return view('welcome'); // Menampilkan halaman welcome
})->name('welcome');

// Rute Login dan Register
Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('register.form'); // Form registrasi
    Route::post('/register', 'register')->name('register');             // Proses registrasi
    Route::get('/login', 'showLoginForm')->name('login.form');          // Form login
    Route::post('/login', 'login')->name('login');                      // Proses login
    Route::post('/logout', 'logout')->name('logout');                   // Proses logout
});

// Rute Dashboard (memerlukan autentikasi)
Route::middleware('auth')->get('/dashboard', [StockController::class, 'dashboard'])->name('dashboard');
Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');

// Rute Stock Management (dengan prefix stocks)
Route::prefix('stocks')->name('stocks.')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [StockController::class, 'dashboard'])->name('dashboard');
    
    // Index route for displaying stock list with pagination
    Route::get('/', [StockController::class, 'index'])->name('index');
    
    // Route for viewing a single stock entry (detail page)
    Route::get('{id}', [StockController::class, 'show'])->name('show');
    
    // Route for creating new stock entry (barang masuk)
    Route::get('create', [StockController::class, 'create'])->name('create');
    Route::post('store', [StockController::class, 'store'])->name('store');
    
    // Route for editing an existing stock entry
    Route::get('{id}/edit', [StockController::class, 'edit'])->name('edit');
    Route::put('{id}', [StockController::class, 'update'])->name('update');
    
    // Route for deleting a stock entry
    Route::delete('{id}', [StockController::class, 'destroy'])->name('destroy');
});

// Rute Produk (Item Management)
Route::resource('produks', ItemController::class);
// `Route::resource` akan menghasilkan:
// - GET    /produks           -> index (daftar produk)
// - GET    /produks/create    -> create (form tambah produk)
// - POST   /produks           -> store (proses simpan produk baru)
// - GET    /produks/{id}      -> show (detail produk)
// - GET    /produks/{id}/edit -> edit (form edit produk)
// - PUT    /produks/{id}      -> update (proses update produk)
// - DELETE /produks/{id}      -> destroy (hapus produk)

// Rute Logout
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Route untuk hapus item 
Route::delete('/item/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// route untuk detail items
Route::get('/produk/{id}', [ItemController::class, 'show'])->name('produk.show');

Route::get('/produk', [ItemController::class, 'index'])->name('produk.index');  // Halaman daftar produk

// Route fitur kasir
Route::resource('transactions', TransactionController::class);

Route::get('/barangmasuk', [StockController::class, 'barangMasukIndex'])->name('barangmasuk.index');
Route::post('/barangmasuk/store', [StockController::class, 'barangMasukStore'])->name('barangmasuk.store');

// router barang masuk baru
Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk.index');
Route::get('/barangmasuk/create', [BarangMasukController::class, 'create'])->name('barangmasuk.create');
Route::post('/barangmasuk', [BarangMasukController::class, 'store'])->name('barangmasuk.store');
Route::get('/barangmasuk/{id}/edit', [BarangMasukController::class, 'edit'])->name('barangmasuk.edit');
Route::put('/barangmasuk/{id}', [BarangMasukController::class, 'update'])->name('barangmasuk.update');
Route::delete('/barangmasuk/{id}', [BarangMasukController::class, 'destroy'])->name('barangmasuk.destroy');
Route::post('/update-stock/{id}', [DashboardController::class, 'updateStock'])->name('stocks.update');


// Rute Dashboard (menggunakan middleware 'auth')
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard');

// route barang keluar
Route::resource('barangkeluar', StockHistoryController::class);

Route::get('/barang-keluar', [StockHistoryController::class, 'index'])->name('barangkeluar.index');

//laporan masuk
Route::get('/laporanmasuk', [LaporanBarangMasukController::class, 'index'])->name('laporanmasuk.index');
Route::get('/laporanmasuk/{tanggal}', [LaporanBarangMasukController::class, 'detail'])->name('laporanmasuk.detail');
   
Route::get('/laporan/barangmasuk/cetak/{tanggal}', [LaporanController::class, 'cetakPDF'])->name('laporan.barangmasuk.cetak');

Route::get('/laporan/barangmasuk/cetak/{tanggal}', [LaporanBarangMasukController::class, 'cetakPDF'])
    ->name('laporan.barangmasuk.cetak');
    
//laporan keluar
Route::get('/laporankeluar', [LaporanBarangKeluarController::class, 'index'])->name('laporankeluar.laporan');

// barang keluar
Route::get('/barangkeluar', [StockOutController::class, 'index'])->name('barangkeluar.index');

//logout
Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('auth.logout');

// Rute Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// transaction kasir 
// routes/web.php
Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaksi.store');


