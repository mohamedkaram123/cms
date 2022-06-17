<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\Customer;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\MyClasses\CoreComponentRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /*protected $redirectTo = '/';*/

    protected function validator(array $data)
    {



        return Validator::make(
            $data,
            [
                'password' => 'required',
                'email' => 'required|email:filter',
            ],
            [
                "password.required" => translate("the password is required"),
                "email.required" => translate("the email is required"),
            ]
        );
    }

    public function user_login3(Request $request)
    {
        $validate =   $this->validator($request->all());

        if ($validate->fails()) {
            return response()->json([
                "status" => 0,
                "msg" => $validate->errors()
            ]);
        }
        $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->first();
        if ($user != null) {
            if (Hash::check($request->password, $user->password)) {
                if ($request->remember) {
                    auth()->login($user, true);
                } else {
                    auth()->login($user, false);
                }

                if (session()->has("cart")) {


                    //  return dd(session()->get("cart"));
                    foreach (session()->get("cart") as $item) {

                        $req = new Request($item);
                        $cartController = new CartController();
                        $cartController->addToCart($req);
                    }
                }
                return response()->json([
                    "status" => 1,
                    "msg" => "done"
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "msg" => translate('Invalid password !')
                ]);
            }
        } else {
            return response()->json([
                "status" => 0,
                "msg" => translate('Invalid email !')
            ]);
        }
    }
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {

        try {
            if ($provider == 'twitter') {
                $user = Socialite::driver('twitter')->user();
            } else {
                $user = Socialite::driver($provider)->stateless()->user();
            }
        } catch (\Exception $e) {
            flash("Something Went wrong. Please try again.")->error();
            return redirect()->route('user.login');
        }

        // check if they're an existing user
        $existingUser = User::where('provider_id', $user->id)->orWhere('email', $user->email)->first();

        if ($existingUser) {
            // log them in


            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->email_verified_at = date('Y-m-d H:m:s');
            $newUser->provider_id     = $user->id;
            $newUser->save();

            $customer = new Customer;
            $customer->user_id = $newUser->id;
            $customer->save();

            auth()->login($newUser, true);
        }
        if (session('link') != null) {
            return redirect(session('link'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return $request->only($this->username(), 'password');
        }
        return ['phone' => $request->get('email'), 'password' => $request->get('password')];
    }

    /**
     * Check user's role and redirect user based on their role
     * @return
     */
    public function authenticated(Request $request, User $user)
    {

        Auth::logoutOtherDevices($request->password);

        if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {

            //   CoreComponentRepository::instantiateShopRepository();
            return redirect()->route('admin.dashboard');
        } else {
            if (session('link') != null) {
                return redirect(session('link'));
            } else {
                return redirect()->route('dashboard');
            }
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        flash(translate('Invalid email or password'))->error();
        return back();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        if (auth()->user() != null && (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')) {
            $redirect_route = 'login';
        } else {
            $redirect_route = 'home';
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route($redirect_route);
        // return dd(App::getLocale());
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }
}
