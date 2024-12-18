<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['ingredient_id', 'kategori_id', 'jumlah', 'tanggal', 'satuan'];

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'ingredient_id', 'ingredient_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id'); // Menyesuaikan dengan nama kolom
    }
    

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function histories()
    {
        return $this->hasMany(StockHistory::class, 'stock_id');
    }

}