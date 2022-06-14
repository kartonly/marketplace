<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id',
       'name',
        'doc_number'
    ];

    public function user():HasOne {
        return $this->hasOne(User::class);
    }

    public function docs():HasMany {
        return $this->hasMany(Docs::class);
    }

    public function products():HasMany {
        return $this->hasMany(Product::class);
    }
}
