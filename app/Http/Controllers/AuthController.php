<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $request->validate([
            "email"=> "required|string|min:3",
            "password"=> "required|string|min:5",
        ]);
        $users = User::all();
        foreach($users as $user) {
            if($user->email== $request->email && Hash::check($request->password, $user->password)){
                return response()->json([
                    "data" => "The User that You Added Is Match With This User".$user->name,
                ]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
       $user =  User::where('email',$request->email)->first();
       if($user && Hash::check($request->password, $user->password)){
        $user->createToken('auth_token')->palinTextToken;
        return response()->json([
            "data" => $user->token,
        ]);
       }
       else{
        return response()->json([
            "data" => "Something went wrong",
        ]);
       }

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
