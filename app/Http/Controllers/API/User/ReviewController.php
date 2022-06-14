<?php


namespace App\Http\Controllers\API\User;


use App\Http\Managers\PhotoManager;
use App\Http\Requests\PhotoRequest;
use App\Models\Review;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    var $manager;

    function __construct() {
        $this->manager = app(PhotoManager::class);
    }

    public function addReview(PhotoRequest $request){
        $user = Auth::id();
        $review = $this->manager->create($request, $user);

        return $review;
    }
}
