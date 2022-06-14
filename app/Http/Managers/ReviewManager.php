<?php


namespace App\Http\Managers;


use App\Models\Review;
use App\Models\User;

class ReviewManager
{
    private ?Review $review;
    private ?User $user;

    public function __construct(?User $user = null, ?Review $review = null)
    {
        $this->user = $user;
        $this->review = $review;
    }

    public function create($review, $user){
        $this->review = new Review;
        $this->review->user_id = $user;
        $this->review->product_id = $review['product'];
        $this->review->title = $review['title'];
        $this->review->stars = $review['stars'];
        $this->review->save();

        return $this->review;
    }
}
