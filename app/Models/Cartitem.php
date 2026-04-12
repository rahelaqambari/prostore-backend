<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartitem extends Model
{
    /** @use HasFactory<\Database\Factories\CartitemFactory> */
    use HasFactory;

     protected $fillable = [
        "price",
        "quntity",
        
    ];
    public function productDetails(){
        return $this->belongsTo(Product::class,"pro_id");
    }
}
