<?php


namespace App\Http\Managers;


use App\Models\Request;
use App\Models\Review;
use App\Models\Shop;
use App\Models\User;

class SellerManager
{
    private ?User $user;
    private ?Request $request;
    private ?Shop $shop;

    public function __construct(?User $user = null, ?Request $request = null, ?Shop $shop = null)
    {
        $this->user = $user;
        $this->request = $request;
        $this->shop = $shop;
    }

    /**
     * User
     */

    public function create($review, $user){
        $this->request = new Request;
        $this->request->user_id = $user;
        $this->request->shop_name = $review->shop_name;
        $this->request->status = Request::STATUS_REVIEW;
        $this->request->doc_number = $review->doc_number;
        $this->request->save();

        return $this->request;
    }

    /**
     * Admin
     */

    public function rejectRequest($request){
        $this->request = $request;
        $this->request->status = Request::STATUS_FALSE;
        $this->request->save();

        return $this->request;
    }

    public function createShop($request){
        $this->shop = new Shop;
        $this->shop->user_id = $request->user_id;
        $this->shop->name = $request->shop_name;
        $this->shop->doc_number = $request->doc_number;
        $this->shop->save();

        $this->request = Request::where('id', $request->id)->first();
        $this->request->status = Request::STATUS_TRUE;
        $this->request->save();

        $this->user = User::where('id', $request->user_id)->first();
        app(RoleManager::class, ['user' => $this->user])->giveSellerRole();

        return [$this->request, $this->shop];
    }
}
