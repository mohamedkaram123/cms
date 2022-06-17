<?php

namespace App\Api\Classes;

use App\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class Auth
{
    public function register($req)
    {
        $user = User::create([
            "name" => $req->name,
            "email" => $req->email,
            "phone" => $req->phone,
            "country_id" => $req->country_id,

            "password" => Hash::make($req->password),
        ]);

        $user = $this->create_token($user);

        //  $user["company"] = $user->company ?? null;

        return $user;
    }




    public function check_email($req)
    {
        $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $req->email)->first();

        return !empty($user) ? $user : false;
    }

    public function check_pass($req, $user)
    {

        $checker = Hash::check($req->password, $user->password);

        return $checker;
    }

    public function attempt($req)
    {
        return FacadesAuth::attempt($req->toArray(), true);
    }

    public function create_token($user)
    {
        $token =  $user->createToken($user->email .  '_Token')->plainTextToken;

        $user["token"] = $token;
        return $user;
    }

    public function token_delete()
    {
        auth()->user()->tokens()->delete();
    }
}
