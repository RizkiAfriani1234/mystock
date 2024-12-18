<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'harga',
        'foto'
    ];

    /**
     * Relasi many-to-many dengan Ingredient melalui tabel pivot item_ingredient.
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'item_ingredient')
            ->withPivot('jumlah', 'satuan') // Tambahkan kolom tambahan dari tabel pivot
            ->withTimestamps(); // Menyimpan waktu created_at dan updated_at
    }

    /**
     * Relasi one-to-many dengan transaksi.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'item_id');
    }
}
