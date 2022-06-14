<?php


namespace App\Http\Managers;


use App\Models\Role;
use App\Models\User;

class RoleManager
{
    private ?User $user;

    public function __construct(?User $user = null)
    {
        $this->user = $user;
    }

    public function giveUserRole(){
        $this->user->assignRole(Role::USER_ROLE);
    }

    public function giveSellerRole(){
        $this->user->removeRole(Role::USER_ROLE);
        $this->user->assignRole(Role::SELLER_ROLE);
    }

    public function giveAdminRole(){
        $this->user->assignRole(Role::ADMIN_ROLE);
    }
}
