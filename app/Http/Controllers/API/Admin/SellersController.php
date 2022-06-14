<?php


namespace App\Http\Controllers\API\Admin;


use App\Http\Controllers\Controller;
use App\Http\Managers\SellerManager;
use App\Models\Request;
use App\Models\Role;
use App\Models\User;

class SellersController extends Controller
{
    var $manager;

    function __construct() {
        $this->manager = app(SellerManager::class);
    }

    public function all(){
        $sellers = User::whereHas('roles', function($q){
            $q->where('name', Role::SELLER_ROLE);})
            ->with('roles')->get();

        return $sellers;
    }

    public function allRequests(){
        return Request::all();
    }

    public function inReviewRequests(){
        return Request::where('status', 'in review')->get();
    }

    public function trueRequests(){
        return Request::where('status', 'true')->get();
    }

    public function falseRequests(){
        return Request::where('status', 'false')->get();
    }

    public function shopRequests($id){
        $request = Request::where('id', $id)->first();

        return $request;
    }

    public function rejectRequest($id){
        $request = Request::where('id', $id)->first();
        $manager = $this->manager->rejectRequest($request);

        return $manager;
    }

    public function createShopFromRequest($id){
        $thisRequest = Request::where('id', $id)->first();
        $manager = $this->manager->createShop($thisRequest);

        return $manager;
    }
}
