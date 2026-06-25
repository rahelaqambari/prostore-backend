<?php

namespace App\Http\Controllers;

use App\Http\Requests\createReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SebastianBergmann\Timer\Exception;

class Reviwcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['user','product'])->get(); 
        return ReviewResource::collection($reviews); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(createReviewRequest $request)
    {
        $review = Review::create($request->validated());
        $review->load(['user','product']);
        return new ReviewResource($review);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
        $review->load(['user','product']);
        return new ReviewResource($review);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function allReviwes(){
        try{
           $review = Review::getDate('created_at','<=',Carbon::now()->subDays(30))->count();
           return response()->json([
            "AllReview" => $review
           ]);
        }
        catch(Exception $err){
            return response()->json([
                "AllReview" => $err->getMessage()
            ]);
        }
    }

    public function lastMonthReviewes(){
        try{
           $lastreview = Review::whereDate('created_at','>=',Carbon::now()->subDays(30))->whereDate('created_at','<=',Carbon::now()->subdays(60))->count();
           return response()->json([
            "lastMonthReviewes" => $lastreview
           ]);
        }
        catch(Exception $err){
            return response()->json([
                "lastMonthReviewes" => $err->getMessage()
            ]);
        }
    }
}
