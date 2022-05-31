<?php

namespace App\Repositories;

use App\Repositories\Interfaces\LoginInterface;
use Illuminate\Support\Str;
class LoginRepository implements LoginInterface{
public function login($data){
    // check request data then create token and return to api
        if (auth()->attempt($data)) {
            $token = Str::random(90);
            auth()->user()->forceFill([
                'api_token' => hash('sha256', $token),
            ])->save();

            return response()->json(['token' => $token],200);
        }else{
            return response(['wrong credentials the email or password is incorrect'], 403);
        }
}
public function logout(){
    // logout from authenticated user
        auth()->user()->forceFill([
            'api_token' =>null,
        ])->save();
        return response()->json(['logged out successfully'], 200);
}
}
