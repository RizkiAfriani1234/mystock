<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up()
    {
        Schema::table('stock_histories', function (Blueprint $table) {
            $table->integer('jumlah')->after('satuan');
            $table->string('unit')->after('jumlah');
        });
    }

    public function down()
    {
        Schema::table('stock_histories', function (Blueprint $table) {
            $table->dropColumn(['jumlah', 'unit']);
        });
    }
};
