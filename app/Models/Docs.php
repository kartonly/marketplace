<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Docs extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'place'
    ];

    public function shop():HasOne {
        return $this->hasOne(User::class);
    }
}
