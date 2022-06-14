<?php

namespace App\Http\Controllers\API\Open;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoriesController extends Controller
{
    public function getAll(){
        return Category::all();
    }
}
