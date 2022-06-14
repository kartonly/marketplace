<?php


namespace App\Http\Managers;


use App\Models\Photos;
use App\Models\Request;
use App\Models\Review;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PhotoManager
{
    private ?Photos $photos;

    public function __construct(?Photos $photos = null)
    {
        $this->photos = $photos;
    }

    public function create($request, $path, $product){
        $this->photos = new Photos;
        $this->photos->product_id = $product;
        $this->photos->place = $path;

        $this->photos->save();

        return $this->photos;
    }


}
