<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('stock_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('stock_id')->after('id'); // Tambahkan kolom stock_id
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade'); // Relasi dengan tabel stocks
        });
    }
    
    public function down()
    {
        Schema::table('stock_histories', function (Blueprint $table) {
            $table->dropForeign(['stock_id']);
            $table->dropColumn('stock_id');
        });
    }
    
};
