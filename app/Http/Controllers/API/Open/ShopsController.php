<?php


namespace App\Http\Controllers\API\Open;


use App\Models\Photos;
use App\Models\Shop;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage as Stor;

class ShopsController extends Controller
{
    public function getAll(){
        return Shop::all();
    }

    public function find($shop){
        $shops = Shop::where('name', 'LIKE', "%{$shop}%")->get();

        return $shops;
    }

    public function products($shop){
        $prods = Shop::where('id', $shop)->first()->products()->get();

        foreach ($prods as $prod) {
            $links = [];
            $photos = Photos::where('product_id', $prod->id)->get();

            foreach ($photos as $item){
                array_push($links, Stor::url($item->place));
            }

            $prod->photos = $links;
        }

        return $prods;
    }
}
