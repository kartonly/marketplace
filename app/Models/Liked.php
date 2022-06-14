<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Liked extends Model
{
    use HasFactory;

    protected $table = 'liked';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function product():HasMany {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}
