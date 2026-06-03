<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    protected $fillable = [ 
        "pro_id",
        "user_id",
    ];

    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function cartitem(){
        return $this->belongsTo(Cartitem::class,"cartitem_id");
    }
    
}
