<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productdetails extends Model
{
    /** @use HasFactory<\Database\Factories\ProductdetailsFactory> */
    use HasFactory;
     protected $fillable = [
        "category",
        "brand",
        "description",
        "pro_id",
    ];

    public function products(){
        return $this->belongsTo(Product::class,"pro_id");
    }
}
