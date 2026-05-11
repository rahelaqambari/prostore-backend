<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" =>$this->name,
            "stock" =>$this->stock,
            "price" =>$this->price,
            "brand" =>$this->productDetails->brand,
            "description" =>$this->productDetails->description,
            "category" =>$this->productDetails->category,
            // "image" =>$this->images->img_url,
            "image" =>$this->images->map(function($images){
                return asset("storage/" .$images->img_url);
            }),
        ];
    }
}
