<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $fillable = [
        'country',
        'city',
        'street',
        'house',
        'user_id'
    ];

    public function user():HasOne {
        return $this->hasOne(User::class);
    }
}
