<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'quantity',
        'total_harga'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }

    protected static function booted()
    {
        static::created(function ($transaction) {
            // Kurangi stok setiap kali transaksi dibuat
            foreach ($transaction->details as $detail) {
                $ingredient = $detail->ingredient;

                if ($ingredient) {
                    $ingredient->stock->decrement('jumlah', $detail->jumlah);
                }
            }
        });
    }
}
