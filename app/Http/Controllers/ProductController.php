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
        $product = Product::create([
            "name"=> $request->name,
            "stock"=> $request->stock,
            "price"=> $request->price,
        ]);
        $product->save();
        // $product->load(['productDatiles','images']);
        $product->productDetails()->create([
            "brand"=> $request->brand,
            "description"=> $request->description,
            "category"=> $request->category,
            "pro_id"=> $request->$product->id,
        ]);

        $images = [];
        if($request->hasFile("image1")){
            $images[] = ["img_url" => $request->file('image1')->store("pro_images","public")];
           
        }
        if($request->hasFile("image2")){
            $images[] = ["img_url" => $request->file('image2')->store("pro_images","public")];
           
        }
        if(!empty($images)){
            $product->images()->createMany($images);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      try{
            $product = Product::findOrFail($id);
            $product->update([
                "name"=>$request->name,
                "price"=>$request->price,
                "stock"=>$request->stock,
            ]);

            $productDetails = Productdetails::where('product_id',$id)->first();
            $productDetails->update([
                "description"=> $request->description,
                "category"=> $request->category,
                "brand"=> $request->brand,
            ]);

            if($request->hasFile('image1')){
                $imgurl =  $request->file('image1')->store('pro_images','public');
                Image::create([
                    "imageable_type"=>Product::class,
                    "imageable_id"=>$product->id,
                    "image_url"=>$imgurl,
                ]);
            }

            return response()->json([
                "data"=> new ProductResource($product),
                "message"=>"Product updated successfully"
            ], 200);

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
        try{
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json([
                "message"=>"Product deleted successfully"
            ], 200);
        }catch(Exception $err){
            return response()->json([
                "error"=>$err->getMessage(),    
            ], 500);                                        
    }
}
