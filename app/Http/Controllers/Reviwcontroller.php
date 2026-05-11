<?php

namespace App\Http\Controllers;

use App\Http\Requests\createReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
