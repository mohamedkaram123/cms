<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AuthData;
use Illuminate\Support\Facades\Validator;
use App\Country;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{



    public function register(Request $req)
    {
        $lang = $req->header("Accept-Language");

        $country = Country::find($req->country_id);

        $data = $req->all();
        $validate = Validator::make(
            $data,
            [
                'name' => 'required|string|max:255',
                'password' =>
                [
                    'required',
                    'min:8',
                    'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@^&=+)(-_]).*$/',
                ],
                'email' => 'required|email:filter|unique:users,email',
                'country_id' => "required",
                'phone' => [
                    "required", "unique:users,email", "min:9", "max:11", function ($attribute, $value, $fail) use ($country, $lang) {
                        if ($country->first_num != null) {
                            // return dd($data["phone"]);
                            if (substr($value, 0, 2) != "0$country->first_num" || substr($value, 0, 2) != "$country->first_num") {

                                $fail(translate("phone not match country", $lang));
                            }
                        }
                    },
                ]


            ],
            [
                "name.required" => translate("the name is required", $lang),
                "password.required" => translate("the password is required", $lang),
                "password.regex" => translate("the password is must be has symbol and UpperCase Charcters", $lang),
                "password.min" => translate("the password is must min 8 chracters", $lang),
                "country_id.required" => translate("the country is required", $lang),

                "email.required" => translate("the email is required", $lang),
                "email.unique" => translate("The email has already been taken", $lang),

                "phone.required" => translate("the phone is required", $lang),
                "phone.unique" => translate("The phone has already been taken", $lang),
                "phone.min" => translate("The phone number more than 8 numbers", $lang),
                "phone.max" => translate("The phone number  more than 11 numbers", $lang)


            ]
        );

        if ($validate->fails()) {
            return response()->json([
                "mag" => translate("error valid", $lang),
                "status" => 0,
                "data" => $validate->errors()->toArray()

            ]);
        }

        $user = AuthData::register($req);

        return response()->json(
            [
                "mag" => translate("register is succes", $lang),
                "status" => 1,
                "data" => $user
            ]
        );
    }


    public function login(Request $req)
    {
        $lang = $req->header("Accept-Language");

        $validate = Validator::make(
            $req->all(),
            [
                "password" => "required|min:6|max:20",
                "email" => "required|email"
            ],
            [
                "email.required" => translate("the email is required", $lang),
                "password.required" => translate("the password is required", $lang)
            ]
        );

        if ($validate->fails()) {
            return response()->json([
                "mag" => translate("error valid", $lang),
                "status" => 0,
                "data" => $validate->errors()->toArray()

            ]);
        }

        if (AuthData::check_email($req)) {
            $user = AuthData::check_email($req);
            if (AuthData::check_pass($req, $user)) {

                $user =   AuthData::create_token($user);

                if (AuthData::attempt($req)) {
                    return response()->json([
                        "mag" => translate("login is succes", $lang),
                        "status" => 1,
                        "data" => $user
                    ]);
                } else {
                    return response()->json([
                        "mag" => translate("error valid",  $lang),
                        "status" => 0,
                        "data" => [
                            "password" => [
                                translate("please check from your password", $lang)
                            ]
                        ]

                    ]);
                }

                return response()->json([
                    "status" => 1,
                    "msg" => $user
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "msg" => translate('Invalid password !', $lang)
                ]);
            }
        } else {
            return response()->json([
                "status" => 0,
                "msg" => translate('Invalid email !', $lang)
            ]);
        }
    }

    public function logout(Request $req)
    {
        $lang = $req->header("Accept-Language");

        AuthData::token_delete();
        return response()->json([
            "mag" => translate("logout is successfully", $lang),
            "status" => 1

        ]);
    }
}
