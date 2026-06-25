<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
         $validated = $request->validate([
            "name"=> "required|string|min:3|max:30",
            "email"=>"required|string|unique:users,email",
            "password"=>"required|string|min:6|confirmed",
            "phone_number" =>"required|min:10"
          
        ]);
        $user = User::create([
            "name"=>$validated["name"],
            "email"=>$validated["email"],
            "password"=> bcrypt($validated['password']),
            "phone_number"=>$validated["phone_number"]
        ]);
        $user->save();
         return response()->json([
            "massege"=>"User Added Successfully",
        ]);





        // token for user 
        // $token = $user->createToken('user_token')->plainTextToken;
        // return response()->json([
        //     "success"=>true,
        //     "user"=> new UserResource($user)
        //     "token"=>$token,
        // ]);
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

     public function alluser(){
        try{
           $currentUser = User::getDate('created_at','<=',Carbon::now()->subDays(30))->count();
           return response()->json([
            "currentUser" => $currentUser
           ]);
        }
        catch(Exception $err){
            return response()->json([
                "currentUser" => $err->getMessage()
            ]);
        }
    }
    
}
