<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        "name",
        "price",
        "stock",
    ];

    public function productDetails(){
        return $this->hasOne(Productdetails::class,"pro_id");
    }

    public function images(){
        return $this->morphMany(Image::class,"imageable");
    }

    public function reviwes(){
        return $this->hasMany(Review::class,"pro_id");
    }
    public function cartItem(){
        return $this->hasMany(Cartitem::class,"pro_id");
    }
}
