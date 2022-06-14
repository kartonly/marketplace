<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Goods extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'count'
    ];

    public function order():HasOne {
        return $this->hasOne(Order::class);
    }
    public function products():HasMany {
        return $this->hasMany(Storage::class);
    }
}
