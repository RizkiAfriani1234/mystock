<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id(); // ID unik untuk detail transaksi
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade'); // Relasi ke tabel transactions
            $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('cascade'); // Relasi ke tabel ingredients
            $table->integer('jumlah'); // Jumlah bahan yang digunakan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
};
