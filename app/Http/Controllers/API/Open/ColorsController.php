<?php


namespace App\Http\Controllers\API\Open;


use Illuminate\Routing\Controller;
use App\Models\Colors;

class ColorsController extends Controller
{
    public function all(){
        return Colors::all();
    }
}
