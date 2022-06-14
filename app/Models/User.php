<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'second_name',
        'gender',
        'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function userRoles(): array
    {
        return $this->roles->transform(function (\Spatie\Permission\Models\Role $role) {
            return $role;
        })->pluck('name', 'id')->toArray();
    }

    public function userPermissions(): array
    {
        return $this->getAllPermissions()->transform(function (\Spatie\Permission\Models\Permission $permission) {
            return $permission;
        })->pluck('name', 'id')->toArray();
    }

    public function address():HasMany{
        return $this->hasMany(Address::class);
    }

    public function request():HasMany {
        return $this->hasMany(Request::class);
    }

    public function shop():HasMany {
        return $this->hasMany(Shop::class);
    }

    public function cart():HasOne {
        return $this->hasOne(Cart::class, 'user_id');
    }

    public function orders():HasMany {
        return $this->hasMany(Order::class);
    }

    public function liked():HasMany {
        return $this->hasMany(Liked::class, 'user_id');
    }
}
