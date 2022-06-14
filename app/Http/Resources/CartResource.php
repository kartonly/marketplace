<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource != null){
            return [
                'id'=>$this->resource->id,
                'title'=>$this->resource->title,
                'desc'=>$this->resource->desc,
                'cost'=>$this->resource->cost,
                'shop'=>$this->resource->shop
            ];
        } else {
            return [];
        }
    }
}
