<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Storage extends Model
{
    use HasFactory;

    protected $table = 'storage';

    protected $fillable = [
        'product_id',
        'size_id',
        'count'
    ];

    public function size():HasOne {
        return $this->hasOne(Sizes::class, 'id', 'size_id');
    }
}
