<?php


namespace App\Http\Controllers\API\Admin;


use App\Http\Controllers\Controller;
use App\Http\Managers\UserManager;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    var $manager;

    function __construct() {
        $this->manager = app(UserManager::class);
    }

    public function all(){
        $users = User::whereHas('roles', function($q){
            $q->where('name', Role::USER_ROLE);})
            ->get();

        return $users;
    }

}
