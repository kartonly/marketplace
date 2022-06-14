<?php


namespace App\Http\Controllers\API\User;


use App\Http\Managers\PhotoManager;
use App\Http\Managers\SellerManager;
use App\Http\Requests\PhotoRequest;
use App\Models\Photos;
use App\Models\Request;
use App\Models\Shop;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    var $manager;
    var $photosManager;

    function __construct() {
        $this->manager = app(SellerManager::class);
        $this->photosManager = app(PhotoManager::class);
    }

    public function requestForShop(\Illuminate\Http\Request $request){
        $user = Auth::id();
        $shopRequest = $this->manager->create($request, $user);

        return $shopRequest;
    }

    public function allRequests(){
        $requests = Request::where('user_id', Auth::id())->where('status', 'in review')->get();

        return $requests;
    }

    public function myRequest($id){
        $request = Request::where('id', $id)->where('status', 'in review')->first();

        return $request;
    }

    public function myShop($id){
        return Shop::where('id', $id)->first();
    }

    public function myShops(){
        return Shop::where('user_id', Auth::id())->get();
    }
}
