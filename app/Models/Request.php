<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Request extends Model
{
    use HasFactory;

    public const STATUS_FALSE = "false";
    public const STATUS_REVIEW = "in review";
    public const STATUS_TRUE = "true";

    protected $fillable = [
        'user_id',
        'shop_name',
        'status',
        'doc_number'
    ];

    public function user():HasOne {
        return $this->hasOne(User::class);
    }
}
