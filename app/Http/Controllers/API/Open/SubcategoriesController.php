<?php

namespace App\Http\Controllers\API\Open;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SubcategoriesController extends Controller
{
    public function getAll(){
        return Subcategory::all();
    }
}
