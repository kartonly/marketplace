<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'product_id',
        'count'
    ];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function user():HasOne {
        return $this->hasOne(User::class);
    }
}
