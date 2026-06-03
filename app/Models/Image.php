<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;
    protected $fillable = [
        "img_url",
        "imageable_id",
        "imageable_type",
    ];

    public function product(){
        return $this->morphTo();
    }

    public function cart(){
        return $this->belongsTo(Cart::class) ;
    }
}
