<?php


namespace App\Http\Managers;


use App\Models\Address;
use App\Models\Cart;
use App\Models\Goods;
use App\Models\Liked;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use App\Http\Managers\PermissionManager;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserManager
{
    private ?User $user;
    private ?Cart $cart;
    private ?Order $order;
    private ?Goods $goods;
    private ?Address $address;
    private ?Liked $liked;

    /**
     * Auth functions
     */

    public function __construct(?User $user = null, ?Cart $cart = null, ?Order $order = null,
                                ?Goods $goods = null, ?Address $address = null, ?Liked $liked = null)
    {
        $this->user = $user;
        $this->cart = $cart;
        $this->order = $order;
        $this->goods = $goods;
        $this->address = $address;
        $this->liked = $liked;
    }

    public function create(array $data): ?User
    {
        $this->user = app(User::class);
        $this->user->fill($data);
        $this->user->password = Hash::make($data['password']);
        $this->user->save();

        app(RoleManager::class, ['user' => $this->user])->giveUserRole();
        app(PermissionManager::class, ['user' => $this->user])->giveUserPermissions();

        return $this->user;
    }

    public function auth($email, $password, $remember)
    {
        $this->user = User::where('email', $email)->first();

        if($this->user == null){
            return 0;
        } else {
            if(!Hash::check($password, optional($this->user)->password)){
                return 1;
            } else {
                $ttl = env('JWT_TTL');
                if ($remember == true)
                {
                    $ttl = env('JWT_REMEMBER_TTL');
                }

                return auth()->setTTL($ttl)->login($this->user);
            }
        }
    }

    public function logout(){
        auth()->logout();
    }

    /**
     * Cart functions
     */

    public function addToCart($user, $product, $count): ?Cart
    {
        $this->cart = new Cart;
        $this->cart->user_id = $user;
        $this->cart->product_id = $product;
        $this->cart->count = $count;
        $this->cart->save();

        return $this->cart;
    }

    public function delFromCart($user, $product){
        $this->cart = Cart::where('user_id', $user)->where('product_id', $product)->first();
        $this->cart->delete();

        return $this->cart;
    }

    public function changeCount($user, $product, $count){
        try {
            DB::beginTransaction();
            $this->cart = Cart::where('user_id', $user)->where('product_id', $product)->first();
            $this->cart->count = $count;
            $this->cart->save();
            DB::commit();

            return $this->cart;

        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * Order functions
     */

    public function createOrder($user, $address, $pay_method, $final, $products, $cart): ?Order
    {
        $this->order = new Order();
        $this->order->user_id = $user;
        $this->order->address_id = $address;
        $this->order->pay_id = $pay_method;
        $this->order->final_cost = $final;
        if ($pay_method == 1){
            $this->order->is_payed = true;
        } else {
            $this->order->is_payed = false;
        }
        $this->order->save();

        foreach ($products as $i){
            $this->goods = new Goods;
            $this->goods->order_id = $this->order->id;
            $this->goods->product_id = $i['id'];
            $this->goods->count = $i['count'];

            $this->goods->save();
        }

        foreach ($cart as $item){
            $cartItem = Cart::where('id', $item->id)->first();
            $cartItem->delete();
        }

        return $this->order;
    }

    /**
     * Address functions
     */

    public function createAddress($user, $address): ?Address
    {
        $this->address = new Address;
        $this->address->user_id = $user;
        $this->address->fill($address);
        $this->address->save();

        return $this->address;
    }

    public function delAddress($id): ?Address
    {
        $this->address = Address::where('id', $id)->first();
        $this->address->delete();

        return $this->address;
    }

    /**
     * Liked functions
     */

    public function addLike($user, $product): ?Liked
    {
        $this->liked = new Liked;
        $this->liked->user_id = $user;
        $this->liked->product_id = $product;
        $this->liked->save();

        return $this->liked;
    }

    public function delLike($id){
        $this->liked = Liked::where('id', $id)->first();
        $this->liked->delete();
    }
}
