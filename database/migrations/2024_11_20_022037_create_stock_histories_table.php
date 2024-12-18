<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stock_histories', function (Blueprint $table) {
            $table->id(); // ID unik untuk history stok
            $table->foreignId('transaction_detail_id')->constrained('transaction_details')->onDelete('cascade'); // Relasi ke tabel transaction_details
            $table->string('nama_bahan'); // Nama bahan yang terlibat dalam history stok
            $table->integer('banyak_bahan'); // Jumlah bahan yang terlibat
            $table->date('tanggal'); // Tanggal transaksi history stok
            $table->string('satuan'); // Satuan dari bahan yang terlibat
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_histories');
    }
};
