<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         //
         $request->validate([
            "email"=> "required|string|min:3",
            "password"=> "required|string|min:5",
        ],[
            "email.min"=>"the Email must be more than 3 chrateres",
            "email.required"=>"the Email is required",
            "email.string"=>"the Email must be a text",
            "password.min"=>"the passwrod must be more than 5 chars",
            "password.required"=>"the password fiald is required",
        ]);
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
