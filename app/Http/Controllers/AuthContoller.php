<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadesResponse;

class AuthContoller extends Controller
{
    public function create(Request $request)
    {
        $user = $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed'
        ]);
        $user = User::create($user);
        $token = $user->createToken('myToken')->plainTextToken;
        return response()->json([
            'message' => 'registered successfully',
            'token' => $token,
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|exists:users,email',
            'password'=>'required'
        ]);
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('myapi')->plainTextToken;
        return FacadesResponse::json([
            'message'=> 'successfully',
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'logout successfully'
        ], 200);
    }
}
