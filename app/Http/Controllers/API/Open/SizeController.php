<?php


namespace App\Http\Controllers\API\Open;


use App\Models\Sizes;
use Illuminate\Routing\Controller;

class SizeController extends Controller
{
    public function all(){
        return Sizes::all();
    }
}
