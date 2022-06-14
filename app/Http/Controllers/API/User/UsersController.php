<?php

namespace App\Http\Controllers\API\User;

use App\Http\Managers\UserManager;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\UserResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Goods;
use App\Models\Liked;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Photos;
use App\Models\Product;
use App\Models\Sizes;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage as Stor;
use PhpParser\Node\Expr\Cast\Object_;
use Ramsey\Uuid\Type\Integer;

class UsersController extends Controller
{
    var $manager;

    function __construct() {
        $this->manager = app(UserManager::class);
    }

    public function user(){
        $user = User::all()->find(Auth::user());

        return new UserResource($user);
    }

    /**
     * Address
     */

    public function addresses(){
        $addresses = Address::where('user_id', Auth::id())->get();

        return $addresses;
    }

    public function address($id){
        $address = Address::where('id', $id)->first();

        return $address;
    }

    public function createAddress(Request $request){
        $address = $this->manager->createAddress(Auth::id(), $request->toArray());

        return $address;
    }

    public function delAddress($id){
        return $this->manager->delAddress($id);
    }

    /**
     * Cart
     */

    public function cart(){
        $id = Auth::id();
        $cart = User::where('id', $id)->first()->cart()->get();

        $products = [];

        foreach ($cart as $cartItem){
            $product = Storage::where('id', $cartItem->product_id)->first();
            $storage = new Storage();
            $storage->product_in_cart_id = $cartItem->id;
            $storage->storage_id = $product->id;
            $storage->size = Sizes::where('id', $product->size_id)->first()->size;
            $storage->product_id = $product->product_id;
            $storage->count = $cartItem->count;
            array_push($products, $storage);
        }

        foreach ($products as $cartItem){
            $product = Product::where('id', $cartItem->product_id)->with('shop')->first();
            $cartItem->product = $product;
        }
        foreach ($products as $product){
            $photos = [];
            $photo = Photos::where('product_id', $product->product->id)->get();

            foreach ($photo as $item){
                array_push($photos, Stor::url($item->place));
            }
            $product->product->photos = $photos;
        }

        return new Response($products);
    }

    public function addToCart(Request $request){
        $products = Cart::where('user_id', Auth::id())->get();
        $count = 0;
        foreach ($products as $item){
            if ($item->product_id == $request->input('product')){
                $count=$count+1;
            }
        }
        if ($count > 0){
            return new Response('Этот товар уже есть в корзине', 400);
        } else {
            $product = $this->manager->addToCart(Auth::id(), $request->input('product'), $request->input('count'));

            return $product;
        }
    }

    public function delFromCart(Request $request){
        $product = $this->manager->delFromCart(Auth::id(), $request->product);

        return $product;
    }

    public function changeCount(Request $request){
        $product = $this->manager->changeCount(Auth::id(), $request->input('product'), $request->input('count'));

        return $product;
    }

    /**
     * Orders
     */

    public function orders(Request $request){
        $id = Auth::id();
        $orders = User::where('id', $id)->first()->orders()->get();

        foreach ($orders as $order){
            $order->address = Address::where('id', $order->address_id)->first();
            $order->pay = Payment::where('id', $order->pay_id)->first();
            $orderId = $order->id;

            $products = Order::where('id', $order->id)->first()->products()->get();
            $storage_array = [];

            foreach ($products as $product){
                $storage = Storage::where('id', $product->product_id)->with('size')->first();
                $storage->count = $product->count;
                array_push($storage_array, $storage);
            }
            $order->products = $storage_array;


            foreach ($order->products as $product){
                $product->product = Product::where('id', $product->product_id)->first();
                $photos = [];
                $photo = Photos::where('product_id', $product->product->id)->get();

                foreach ($photo as $item){
                    array_push($photos, Stor::url($item->place));
                }
                $product->product->photos = $photos;
            }
        }

        return new Response(OrdersResource::collection($orders)->toArray($request));

    }

    public function order($id){
        $order = Order::where('id', $id)->with('payment', 'address')->first();
        $products = Order::where('id', $id)->first()->products()->get();
        $storage_array = [];

        foreach ($products as $product){
            $storage = Storage::where('id', $product->product_id)->with('size')->first();
            $storage->count = Goods::where('order_id', $order->id)->where('product_id', $storage->id)->first()->count;
            array_push($storage_array, $storage);

        }
        $order->products = $storage_array;

        foreach ($order->products as $product){
            $product->product = Product::where('id', $product->product_id)->first();
            $photos = [];
            $photo = Photos::where('product_id', $product->product->id)->get();

            foreach ($photo as $item){
                array_push($photos, Stor::url($item->place));
            }
            $product->product->photos = $photos;
        }

        return new Response($order);
    }

    public function createOrder(Request $request){
        $cost = 0;
        $noInStock = [];
        foreach ($request->input('products') as $i){
            $storage = Storage::where('id', $i['id'])->first();
            $product = Product::where('id', $storage->product_id)->first();
            $cost = $cost+$product->cost*$i['count'];
            if ($storage->count = 0){
                array_push($noInStock, $storage);
            }
        }
        if ($noInStock == []){
            $cart = Cart::where('user_id', Auth::id())->get();
            $newOrder = $this->manager->createOrder(Auth::id(), $request->input('address'),
                $request->input('pay_method'), $cost, $request->input('products'), $cart);
                foreach ($request->input('products') as $i){
                    $storage = Storage::where('id', $i['id'])->first();
                    $storage->count = $storage->count - 1;
                    $storage->save();
                }
            return $newOrder;
        } else {
            return $noInStock;
        }
    }

    /**
     * Like
     */

    public function liked()
    {
        $liked = Liked::where('user_id', Auth::id())->get();
        $products = [];

        foreach ($liked as $like){
            array_push($products, Product::where('id', $like->product_id)->first());
        }
        foreach ($products as $product) {
            $photos = [];
            $photo = Photos::where('product_id', $product->id)->get();

            foreach ($photo as $item){
                array_push($photos, Stor::url($item->place));
            }
            $product->photos = $photos;
        }
        if ($products == []){
            return new Response('Вы пока не добавили ни один товар в избранное', 200);
        } else {
            return $products;
        }

    }

    public function addLike($id){
        return $this->manager->addLike(Auth::id(), $id);
    }

    public function delLike($id){
        return $this->manager->delLike($id);
    }
}
