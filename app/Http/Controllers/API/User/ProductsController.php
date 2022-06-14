<?php


namespace App\Http\Controllers\API\User;


use App\Http\Controllers\Controller;
use App\Http\Managers\PhotoManager;
use App\Http\Managers\ProductsManager;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\Seller\ProductRequest;
use App\Http\Requests\Seller\StorageRequest;
use App\Http\Requests\ShopRequest;

class ProductsController extends Controller
{
    var $photosManager;
    var $productsManager;

    function __construct() {
        $this->photosManager = app(PhotoManager::class);
        $this->productsManager = app(ProductsManager::class);
    }

    public function addPhoto(PhotoRequest $request, $product){

        $path = $request->file('image')->store('public/images');

        $manager = $this->photosManager->create($request->all(), $path, $product);


        return new \Illuminate\Http\Response(200);

    }
    public function index()
    {
        return view('image');
    }

    public function addProduct(ProductRequest $request){
        $product = $this->productsManager->create($request->all());

        return $product;
    }

    public function addStorage(StorageRequest $request, $product){
        $storage = $this->productsManager->addStorage($request, $product);

        return $storage;
    }
}
