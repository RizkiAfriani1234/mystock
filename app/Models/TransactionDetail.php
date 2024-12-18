<?php

namespace App\Models;

use App\Models\Ingredient;
use App\Models\Transaction;
use App\Models\StockHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'ingredient_id',
        'jumlah',
        'unit'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function stockHistories()
    {
        return $this->hasMany(StockHistory::class, 'transaction_detail_id');
    }
}
