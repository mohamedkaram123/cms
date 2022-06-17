<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\BusinessSetting;
use App\Country;
use App\Http\Controllers\CartController;
use App\OtpConfiguration;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\OTPVerificationController;
use App\Notifications\EmailVerificationNotification;
use App\Seller;
use App\Shop;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cookie;
use Illuminate\Contracts\Session\Session;
use Illuminate\Notifications\Messages\MailMessage;
use Nexmo;
use Twilio\Rest\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {


        $country = Country::find($data["country_id"]);

        return Validator::make(
            $data,
            [
                'name' => 'required|string|max:255',
                'password' =>
                [
                    'required',
                    'min:8',
                    'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@^&=+)(-_]).*$/',
                    'confirmed'
                ],
                'email' => 'required|email:filter',
                'country_id' => "required",
                'phone' => [
                    "required", "unique:users,email", "min:9", "max:20", function ($attribute, $value, $fail) use ($country, $data) {
                        if ($country->first_num != null) {
                            // return dd($data["phone"]);
                            if (substr($value, 0, 2) != "0$country->first_num" || substr($value, 0, 2) != "$country->first_num") {

                                $fail(translate("phone not match country"));
                            }
                        }
                    },
                ]


            ],
            [
                "name.required" => translate("the name is required"),
                "password.required" => translate("the password is required"),
                "password.confirmed" => translate("the password is must be confirmed"),
                "password.regex" => translate("the password is must be has symbol and UpperCase Charcters"),
                "password.min" => translate("the password is must min 8 chracters"),
                "country_id.required" => translate("the country is required"),

                "email.required" => translate("the email is required"),
                "phone.required" => translate("the phone is required"),
                "phone.unique" => translate("The phone has already been taken"),
                "phone.min" => translate("The phone number more than 8 numbers"),
                "phone.max" => translate("The phone number  more than 11 numbers")


            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(array $data)
    {
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'country_id' => $data['country_id'],

                'password' => Hash::make($data['password']),
            ]);

            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->save();
        } else {
            if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated) {
                $user = User::create([
                    'name' => $data['name'],
                    'phone' => '+' . $data['country_code'] . $data['phone'],
                    'password' => Hash::make($data['password']),
                    'verification_code' => rand(100000, 999999)
                ]);

                $customer = new Customer;
                $customer->user_id = $user->id;
                $customer->save();

                $otpController = new OTPVerificationController;
                $otpController->send_code($user);
            }
        }

        if (Cookie::has('referral_code')) {
            $referral_code = Cookie::get('referral_code');
            $referred_by_user = User::where('referral_code', $referral_code)->first();
            if ($referred_by_user != null) {
                $user->referred_by = $referred_by_user->id;
                $user->save();
            }
        }

        return $user;
    }


    public static function auto_register_customers($loop)
    {

        $user_ids = [];

        for ($i = 1000; $i < $loop; $i++) {

            $data = [];
            $data['name'] = "seller" . $i;
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['name'] . $i . '@mail.com',
                'user_type' => 'seller',
                'password' => Hash::make(123456),
                'email_verified_at' => now()
            ]);

            $user_ids[] = $user->id;

            $seller = new Seller;
            $seller->user_id = $user->id;
            $seller->verification_status = 1;


            $seller->save();

            $shop = new Shop;
            $shop->user_id = $user->id;
            $shop->name = "shop" . $i;
            $shop->logo = rand(16, 117);

            $shop->address = "shop adress" . $i;
            $shop->slug = preg_replace('/\s+/', '-',  $shop->name) . '-' . $shop->id;
            $shop->save();
        }

        return $user_ids;
    }

    // public function register_otp(Request $request)
    // {

    //     // if ($this->validator($request->all())) {
    //     //     return back();
    //     // }
    //     // return  dd($request->all());
    //     $request->session()->put('user', $request->all());

    //     $tel = !empty(Country::find($request->country_id)) ? Country::find($request->country_id)->tel : "";
    //     if ($request->phone != "" && $request->phone != null) {
    //         return view("auth.otp", [
    //             "phone" => $request->phone,
    //             "tel" => $tel
    //         ]);
    //     }


    //     return   $this->register($request);
    // }

    public function register_user(Request $request)
    {

        $validate =   $this->validator($request->all());

        if ($validate->fails()) {
            return response()->json([
                "status" => 0,
                "msg" => $validate->errors()
            ]);
        }
        $user = $this->create($request->all());


        if (get_setting("email_verification") != 1) {
            $user->email_verified_at = now();
            $user->save();
        } else {
            $user->sendEmailVerificationNotification();
        }



        $this->guard()->login($user);


        if (session()->has("cart")) {

            $data["products"] = [];
            $data["customer_id"] =  auth()->user()->id;

            $i = 0;

            //  return dd(session()->get("cart"));
            foreach (session()->get("cart") as $item) {

                $req = new Request($item);
                //$req->request->add(['products' => $item]);

                // return dd($req);
                $cartController = new CartController();

                //if ($i == 2) {
                $cartController->addToCart($req);
            }
        }

        if (
            $user->email == null
        ) {

            return response()->json([
                "status" => 1,
                "msg" => "done",
                "url" => route('verification')
            ]);
        } else {
            return response()->json([
                "status" => 1,
                "msg" => "done",
                "url" => route('home')
            ]);

            //            return redirect()->route('verification.resend');
        }
    }

    public function register(Request $request)
    {

        if (session()->has("user")) {
            $request->request->add(session()->get("user"));
        }


        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if (User::where('email', $request->email)->first() != null) {
                flash(translate('Email or Phone already exists.'));
                return back();
            }
        } elseif (User::where('phone', '+' . $request->country_code . $request->phone)->first() != null) {
            flash(translate('Phone already exists.'));
            return back();
        }





        $this->validator($request->all())->validate();
        // return dd($request->all());

        if (get_setting("register_otp") == 1) {
            $request->session()->put('user', $request->all());
            $tel = !empty(Country::find($request->country_id)) ? Country::find($request->country_id)->tel : "";
            if ($request->phone != "" && $request->phone != null) {
                return view("auth.otp", [
                    "phone" => $request->phone,
                    "tel" => $tel,

                ]);
            }
        }

        $request = new Request($request->all());
        return  $this->register_otp_data($request);
    }


    public function user_register3(Request $request)
    {



        // setCookie("momoc", "channel", time() + 60);
        //  setCookiess("BOLLA", "AOOOO", 1);
        //   return dd($getCookie));

        if (session()->has("user")) {
            $request->request->add(session()->get("user"));
        }


        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if (
                User::where('email', $request->email)->first() != null
            ) {

                return response()->json([
                    "status" => 0,
                    "msg" => translate('Email already exists.')
                ]);
            }
        } elseif (User::where('phone', '+' . $request->country_code . $request->phone)->first() != null) {

            return response()->json([
                "status" => 0,
                "msg" => translate('Phone already exists.')
            ]);
        }





        $validate =   $this->validator($request->all());

        if ($validate->fails()) {
            return response()->json([
                "status" => 0,
                "msg" => $validate->errors()
            ]);
        }


        if (get_setting("register_otp") == 1) {
            $request->session()->put('user', $request->all());
            $tel = !empty(Country::find($request->country_id)) ? Country::find($request->country_id)->tel : "";
            if ($request->phone != "" && $request->phone != null) {
                return response()->json([
                    "status" => 1,
                    "msg" => "done",
                    "url" => route('auth_otp', [
                        "phone" => $request->phone,
                        "tel" => $tel
                    ])
                ]);
            }
        }

        $request = new Request($request->all());
        return  $this->register_otp_data3($request);
    }

    public function auth_otp($phone, $tel)
    {
        return view(
            "auth.otp",
            [
                "phone" => $phone,
                "tel" => $tel,

            ]
        );
    }
    public function register_otp_data3(Request $request)
    {




        //    return dd($request->all());
        $user = $this->create(get_setting("register_otp") != 1 ? $request->all() : $request->session()->get('user'));

        if (get_setting("email_verification") != 1) {
            $user->email_verified_at = now();
            $user->save();
        } else {
            $user->sendEmailVerificationNotification();
        }



        $this->guard()->login($user);


        if (session()->has("cart")) {

            $data["products"] = [];
            $data["customer_id"] =  auth()->user()->id;

            $i = 0;

            //  return dd(session()->get("cart"));
            foreach (session()->get("cart") as $item) {

                $req = new Request($item);
                //$req->request->add(['products' => $item]);

                // return dd($req);
                $cartController = new CartController();

                //if ($i == 2) {
                $cartController->addToCart($req);
            }
        }

        if (
            $user->email == null
        ) {

            return response()->json([
                "status" => 1,
                "msg" => "done",
                "url" => route('verification')
            ]);
        } else {
            return response()->json([
                "status" => 1,
                "msg" => "done",
                "url" => route('home')
            ]);

            //            return redirect()->route('verification.resend');
        }
    }
    public function register_otp_data(Request $request)
    {





        //    return dd($request->all());
        $user = $this->create(get_setting("register_otp") != 1 ? $request->all() : $request->session()->get('user'));

        if (get_setting("email_verification") != 1) {
            $user->email_verified_at = now();
            $user->save();
        } else {
            $user->sendEmailVerificationNotification();
        }



        $this->guard()->login($user);


        if (session()->has("cart")) {

            $data["products"] = [];
            $data["customer_id"] =  auth()->user()->id;

            $i = 0;

            //  return dd(session()->get("cart"));
            foreach (session()->get("cart") as $item) {

                $req = new Request($item);
                //$req->request->add(['products' => $item]);

                // return dd($req);
                $cartController = new CartController();

                //if ($i == 2) {
                $cartController->addToCart($req);
            }
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {

        if ($user->email == null) {
            return redirect()->route('verification');
        } else {
            return redirect()->route('home');

            //            return redirect()->route('verification.resend');
        }
    }
}
