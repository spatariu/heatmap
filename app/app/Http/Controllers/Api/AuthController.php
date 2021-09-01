<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\User;

class AuthController extends Controller {

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:55',
                    'email' => 'email|required|unique:users',
                    'password' => 'required|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()], 400);
        } else {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            $accessToken = $user->createToken('authToken')->accessToken;

            return response(['user' => $user, 'access_token' => $accessToken]);
        }
    }

    public function login(Request $request) {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
                    'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request) {
        return response()->json($request->user());
    }

}
