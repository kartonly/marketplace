<?php

namespace App\Http\Controllers\API\Open;

use App\Models\Category;
use App\Models\Goods;
use App\Models\Liked;
use App\Models\Order;
use App\Models\Photos;
use App\Models\Product;
use App\Models\Review;
use App\Models\Shop;
use App\Models\Sizes;
use App\Models\Storage;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage as Stor;

class ProductController extends Controller
{
    public function getPhoto(){
        return Stor::url('public/images/8PrKVrZiPCOMP8ElgVnz8gICbcOMUh2Q2H5XufpH.jpg');
    }

    public function getAll(){
        $products = Product::all();
        foreach ($products as $product){
            $photos = [];
            $subcategory = Subcategory::where('id', $product->subcategory_id)->first();
            $category = Category::where('id', $subcategory->category_id)->first();
            $product->shop = Shop::where('id', $product->shop_id)->first()->name;
            $product->category = $category->trans;
            $product->category_name = $category->title;
            $photo = Photos::where('product_id', $product->id)->get();

            foreach ($photo as $item){
                array_push($photos, Stor::url($item->place));
            }
            $product->photos = $photos;

        }

        return $products;
    }

    public function getByCategory($category, $gender){
        $products = Product::with('subcategory')->get();
        $ready_products = [];

        foreach ($products as $product){
            $photos = [];
            $photo = Photos::where('product_id', $product->id)->get();

            foreach ($photo as $item){
                array_push($photos, Stor::url($item->place));
            }
            $product->photos = $photos;

            if ($product->gender == $gender){
                foreach ($product->subcategory as $sub){
                    $cat = Category::where('id', $sub->category_id)->first();
                    if ($cat->trans == $category){
                        $product->category_name = $cat->title;
                        array_push($ready_products, $product);
                    }
                }
            }
        }

        foreach ($ready_products as $product){
            $shop = Shop::where('id', $product->shop_id)->first();
            $product->shop = $shop->name;
        }

        return new Response($ready_products);
    }

    public function byCatWithoutGender($category){
        $products = Product::with('subcategory')->get();
        $ready_products = [];

        foreach ($products as $product){
            $photos = [];
            $photo = Photos::where('product_id', $product->id)->get();

            foreach ($photo as $item){
                array_push($photos, Stor::url($item->place));
            }
            $product->photos = $photos;

            foreach ($product->subcategory as $sub){
                $cat = Category::where('id', $sub->category_id)->first();
                if ($cat->trans == $category){
                    array_push($ready_products, $product);
                }
            }
        }
        return new Response($ready_products);
    }

    public function getByGender($gender){
        $products = Product::all();
        $ready_products = [];

        foreach ($products as $product){
            if ($product->gender == $gender){
                array_push($ready_products, $product);
            }
        }

        foreach ($ready_products as $product){
            $photos = [];
            $photo = Photos::where('product_id', $product->id)->get();

            foreach ($photo as $item){
                array_push($photos, Stor::url($item->place));
            }
            $product->photos = $photos;
        }
        return $ready_products;
    }

    public function getBySubcategory($subcategory, $gender){
        $products = Product::with('subcategory')->get();
        $ready_products = [];

        foreach ($products as $product){
            if ($product->gender == $gender){
                $sub = Subcategory::where('id', $product->subcategory_id)->first();
                if ($sub->trans == $subcategory){
                    array_push($ready_products, $product);
                }
            }
        }

        foreach ($ready_products as $product){
            $photos = [];
            $photo = Photos::where('product_id', $product->id)->get();

            foreach ($photo as $item){
                array_push($photos, Stor::url($item->place));
            }
            $product->photos = $photos;
        }
        return new Response($ready_products);
    }

    public function storageByProduct($id){
        $product = Product::where('id', $id)->first();
        $product->storage = Product::where('id', $id)->first()->storage()->get();
        $reviews = Review::where('product_id', $product->id)->get();
        $subcategory = Subcategory::where('id', $product->subcategory_id)->first();
        $category = Category::where('id', $subcategory->category_id)->first();
        $product->subcategory = $subcategory->title;
        $product->category = $category->title;
        $product->subcategoryTrans = $subcategory->trans;
        $product->categoryTrans = $category->trans;

        foreach ($product->storage as $storage){
            $size = Sizes::where('id', $storage->size_id)->first();
            $storage->size = $size->size;
        }

        foreach ($reviews as $review){
            $user = User::where('id', $review->user_id)->first();
            $review->user_name = $user->first_name;
        }
        $product->reviews = $reviews;

        $stars = 0;
        if (count($reviews)>0){
            foreach ($reviews as $review){
                $stars += $review->stars;
            }
            $product->stars = $stars/count($reviews);
        }
        if (Auth::check()){
            $liked = Liked::where('user_id', Auth::id())->get();
            $products = [];

            foreach ($liked as $like){
                array_push($products, Product::where('id', $like->product_id)->first());
            }
            foreach ($products as $i){
                if ($i->id == $product->id){
                    $product->liked = 1;
                } else {
                    $product->liked = 0;
                }
            }
        }

        $photos = [];
        $photo = Photos::where('product_id', $product->id)->get();

        foreach ($photo as $item){
            array_push($photos, Stor::url($item->place));
        }
        $product->photos = $photos;
        $product->shop = Shop::where('id', $product->shop_id)->first()->name;

        return $product;
    }

    public function find($product){
        $products = Product::where('title', 'LIKE', "%{$product}%")->get();
        $ready = [];

        foreach ($products as $product){
            $subcategory = Subcategory::where('id', $product->subcategory_id)->first()->category_id;
            $category = Category::where('id', $subcategory)->first();
            $product->category = $category->trans;
            $product->shop = Shop::where('id', $product->shop_id)->first()->name;

            array_push($ready, $product);
        }
        foreach ($ready as $product){
            $photos = [];
            $photo = Photos::where('product_id', $product->id)->get();

            foreach ($photo as $item){
                array_push($photos, Stor::url($item->place));
            }
            $product->photos = $photos;
        }

        return $ready;
    }

    public function topSales(): array
    {
        $goods = Goods::all();
        $products = [];

        foreach ($goods as $good){
            $storage = Storage::where('product_id', $good->product_id)->first();
            $product = Product::where('id', $storage->product_id)->first();
            if (array_key_exists($product->id, $products)) {
                $count = $products[$product->id];
                unset($products[$product->id]);
                $products += [$product->id=>$good->count+$count];
            } else {$products += [$product->id=>$good->count];}

        }
        arsort($products);

        $productsObjects = [];
        $flip = array_flip($products);
        $cut = array_slice($flip, 0, 5);

        foreach ($cut as $product){
            array_push($productsObjects, Product::where('id', $product)->first());
        }

        return $productsObjects;
    }
}
