<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Image;
use App\Models\Product;
use App\Models\Productdetails;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Product::with(['productDetails','images'])->paginate(10);
        return ProductResource::collection($data);
        // return response()->json([
        //     "data"=> $data,
        //     "message"=>"Success"
        // ], 200);
    }                                        

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        $product = new Product();
        $product->create([
            "name"=> $request->name,
            "stock"=> $request->stock,
            "price"=> $request->price,
        ]);
        $product->save();

        $productDetails = new Productdetails();
        $productDetails->create([
            "brand"=> $request->barnd,
            "description"=> $request->description,
            "product_id"=> $request->id,
            "category"=> $request->cat,
        ]);
        $productDetails->save();
        $path = null;
        if($request->hasFile("image")){
            $path = $request->file("image")->store("pro_img","public");
        }
        $image = new Image();
        $image->create([
            "image_url"=> $path,
            "imageable_id"=> $product,
            "imageable_type"=> Product::class
        ]);
        $image->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Product::findOrFail($id);
            return response()->json([
            "data"=> $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try{
           $product =  Product::findOrFail($id)->first();
           $product->update([
            "name"=>$request->name,
            "price"=>$request->price,
            "stock"=>$request->stock,
           ]);
           $product->save();


           $productDetails = Productdetails::where("product_id",$product->id)->first();
           $productDetails->update(
            [
                "description"=> $request->description,
                "category"=> $request->category,
                "brand"=> $request->brand,
            ]
           );
           $productDetails->save();
        //    image
        $imgurl = null;
        $imgurl2 = null;
        if($request->hasFile('image1')){
          $imgurl =  $request->file('image1')->store('pro_images','public');

        }
        $images = Image::where('imageable_type',Product::class)->where('imageable_id',$product->id)->get();
        if($i = 0; count($images)>0; $i++){
            $images->update([
            "imageable_type"=>$product->id,
            "image_url"=>$imgurl,
        ]);
        }
        else{
            $images->update([
                "image_url"=>$imgurl2
            ]);
        }
        

        }catch(Exception $err){
            return response()->json(
                [
                    "error"=>$err->getMessage(),
                ]
            );

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
