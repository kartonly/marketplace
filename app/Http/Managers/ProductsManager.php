<?php


namespace App\Http\Managers;


use App\Models\Photos;
use App\Models\Product;
use App\Models\Request;
use App\Models\Review;
use App\Models\Shop;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ProductsManager
{
    private ?Product $product;
    private ?Storage $storage;

    public function __construct(?Product $product = null, ?Storage $storage = null)
    {
        $this->product = $product;
        $this->storage = $storage;
    }

    public function create($request){
        $this->product->fill($request);
        $this->product->save();

        return $this->product;
    }

    public function addStorage($request, $product){
        $this->storage->size_id = $request->size_id;
        $this->storage->count = $request->count;
        $this->storage->product_id = $product;
        $this->storage->save();

        return $this->storage;
    }
}
