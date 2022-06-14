<?php


namespace App\Models;

use Spatie\Permission\Models\Role as ParentRole;

class Role extends ParentRole
{
    public const USER_ROLE = 'user';
    public const SELLER_ROLE = 'seller';
    public const ADMIN_ROLE = 'admin';

    public const ROLES = [
        self::USER_ROLE,
        self::SELLER_ROLE,
        self::ADMIN_ROLE,
    ];

    public $guard_name = 'api';
}
