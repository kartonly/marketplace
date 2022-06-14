<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Testing\Fluent\Concerns\Has;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';

    protected $fillable = [
      'user_id',
      'address_id',
      'pay_id',
      'final_cost',
      'is_payed'
    ];

    public function user():HasOne {
        return $this->hasOne(User::class);
    }

    public function address():HasOne {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function payment():HasOne {
        return $this->hasOne(Payment::class, 'id');
    }

    public function products():HasMany {
        return $this->hasMany(Goods::class);
    }
}
