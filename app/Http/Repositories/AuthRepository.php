<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiDesignTrait;
use App\Models\User;

class AuthRepository implements AuthInterface
{
    use ApiDesignTrait;

    public function login()
    {

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return $this->ApiResponse(422, 'unauthorized');
            // return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $userData = User::where('id',auth()->user()->id)->with('roleName')->first();


        $data = [
            'name' => $userData->name,
            'email' => $userData->email,
            'phone' => $userData->phone,
            'status' => $userData->status,
            'role_id' => $userData->role_id,
            'role' => $userData->roleNAme->name,
            //'role' => auth()->user()->roleName->name,
            'access_token' => $token,
        ];

        return $this->ApiResponse(200,'Done',null,$data);


    }
}
