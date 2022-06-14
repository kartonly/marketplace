<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'title',
        'desc',
        'cost',
        'subcategory_id',
        'gender',
        'color_id'
    ];

    public function shop():HasOne {
        return $this->hasOne(Shop::class, 'id');
    }

    public function storage():HasMany {
        return $this->hasMany(Storage::class, 'product_id', 'id');
    }

    public function photos():HasMany {
        return $this->hasMany(Photos::class);
    }

    public function subcategory():HasMany {
        return $this->hasMany(Subcategory::class, 'id', 'subcategory_id');
    }

    public function color():HasOne {
        return $this->hasOne(Colors::class, 'id', 'color_id');
    }
}
