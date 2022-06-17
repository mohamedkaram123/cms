<?php

use App\Attribute;
use App\Currency;
use App\BusinessSetting;
use App\Models\Product;
use App\SubSubCategory;
use App\FlashDealProduct;
use App\FlashDeal;
use App\OtpConfiguration;
use App\Upload;
use App\Translation;
use App\City;
use App\Models\Cart;
use App\Models\Country;
use App\Models\GeneralTranslation;

use App\Utility\TranslationUtility;
use App\Utility\CategoryUtility;
use App\Utility\MimoUtility;
use App\MyClasses\Colorcodeconverter;
use App\MyClasses\SpcialOffer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;
use App\Models\Language;

//highlights the selected navigation on admin panel
if (!function_exists('sendSMS')) {
    function sendSMS($to, $from, $text)
    {
        if (OtpConfiguration::where('type', 'nexmo')->first()->value == 1) {
            $api_key = env("NEXMO_KEY"); //put ssl provided api_token here
            $api_secret = env("NEXMO_SECRET"); // put ssl provided sid here

            $params = [
                "api_key" => $api_key,
                "api_secret" => $api_secret,
                "from" => $from,
                "text" => $text,
                "to" => $to
            ];

            $url = "https://rest.nexmo.com/sms/json";
            $params = json_encode($params);

            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($params),
                'accept:application/json'
            ));
            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
        } elseif (OtpConfiguration::where('type', 'twillo')->first()->value == 1) {
            $sid = env("TWILIO_SID"); // Your Account SID from www.twilio.com/console
            $token = env("TWILIO_AUTH_TOKEN"); // Your Auth Token from www.twilio.com/console

            $client = new Client($sid, $token);
            try {
                $message = $client->messages->create(
                    $to, // Text this number
                    array(
                        'from' => env('VALID_TWILLO_NUMBER'), // From a valid Twilio number
                        'body' => $text
                    )
                );
            } catch (\Exception $e) {
            }
        } elseif (OtpConfiguration::where('type', 'ssl_wireless')->first()->value == 1) {
            $token = env("SSL_SMS_API_TOKEN"); //put ssl provided api_token here
            $sid = env("SSL_SMS_SID"); // put ssl provided sid here

            $params = [
                "api_token" => $token,
                "sid" => $sid,
                "msisdn" => $to,
                "sms" => $text,
                "csms_id" => date('dmYhhmi') . rand(10000, 99999)
            ];

            $url = env("SSL_SMS_URL");
            $params = json_encode($params);

            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($params),
                'accept:application/json'
            ));

            $response = curl_exec($ch);

            curl_close($ch);

            return $response;
        } elseif (OtpConfiguration::where('type', 'fast2sms')->first()->value == 1) {

            if (strpos($to, '+91') !== false) {
                $to = substr($to, 3);
            }


            $fields = array(
                "sender_id" => env("SENDER_ID"),
                "message" => $text,
                "language" => env("LANGUAGE"),
                "route" => env("ROUTE"),
                "numbers" => $to,
            );

            $auth_key = env('AUTH_KEY');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($fields),
                CURLOPT_HTTPHEADER => array(
                    "authorization: $auth_key",
                    "accept: */*",
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            return $response;
        } elseif (OtpConfiguration::where('type', 'mimo')->first()->value == 1) {
            $token = MimoUtility::getToken();

            MimoUtility::sendMessage($text, $to, $token);
            MimoUtility::logout($token);
        }
    }
}

//highlights the selected navigation on admin panel
if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

//highlights the selected navigation on frontend
if (!function_exists('areActiveRoutesHome')) {
    function areActiveRoutesHome(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

//highlights the selected navigation on frontend
if (!function_exists('default_language')) {
    function default_language()
    {
        return env("DEFAULT_LANGUAGE");
    }
}

/**
 * Save JSON File
 * @return Response
 */
if (!function_exists('convert_to_usd')) {
    function convert_to_usd($amount)
    {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if ($business_settings != null) {
            $currency = Currency::find($business_settings->value);
            return (floatval($amount) / floatval($currency->exchange_rate)) * Currency::where('code', 'USD')->first()->exchange_rate;
        }
    }
}

if (!function_exists('convert_to_kes')) {
    function convert_to_kes($amount)
    {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if ($business_settings != null) {
            $currency = Currency::find($business_settings->value);
            return (floatval($amount) / floatval($currency->exchange_rate)) * Currency::where('code', 'KES')->first()->exchange_rate;
        }
    }
}

//filter products based on vendor activation system
if (!function_exists('filter_products')) {
    function filter_products($products)
    {
        $verified_sellers = verified_sellers_id();
        if (BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1) {
            return $products->where('published', '1')->orderBy('created_at', 'desc')->where(function ($p) use ($verified_sellers) {
                $p->where('added_by', 'admin')->orWhere(function ($q) use ($verified_sellers) {
                    $q->whereIn('user_id', $verified_sellers);
                });
            });
        } else {
            return $products->where('published', '1')->where('added_by', 'admin');
        }
    }
}

//cache products based on category
if (!function_exists('get_cached_products')) {
    function get_cached_products($category_id = null)
    {
        $products = \App\Product::where('published', 1);
        $verified_sellers = verified_sellers_id();
        if (BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1) {
            $products =  $products->where(function ($p) use ($verified_sellers) {
                $p->where('added_by', 'admin')->orWhere(function ($q) use ($verified_sellers) {
                    $q->whereIn('user_id', $verified_sellers);
                });
            });
        } else {
            $products = $products->where('added_by', 'admin');
        }

        if ($category_id != null) {
            return Cache::remember('products-category-' . $category_id, 86400, function () use ($category_id, $products) {
                $category_ids = CategoryUtility::children_ids($category_id);
                $category_ids[] = $category_id;
                return $products->whereIn('category_id', $category_ids)->latest()->take(12)->get();
            });
        } else {
            return Cache::remember('products', 86400, function () use ($products) {
                return $products->latest()->get();
            });
        }
    }
}

if (!function_exists('verified_sellers_id')) {
    function verified_sellers_id()
    {
        return App\Seller::where('verification_status', 1)->get()->pluck('user_id')->toArray();
    }
}

//converts currency to home default currency
if (!function_exists('convert_price')) {
    function convert_price($price)
    {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if ($business_settings != null) {
            $currency = Currency::find($business_settings->value);
            $price = floatval($price) / floatval($currency->exchange_rate);
        }

        $code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        if (Session::has('currency_code')) {
            $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        } else {
            $currency = Currency::where('code', $code)->first();
        }

        $price = floatval($price) * floatval($currency->exchange_rate);

        return $price;
    }
}


//converts currency to home default currency
if (!function_exists('convert_price_object')) {
    function convert_price_object($data)
    {


        $prices = [];
        foreach ($data as $key => $price) {

            $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
            if ($business_settings != null) {
                $currency = Currency::find($business_settings->value);
                $price = floatval($price) / floatval($currency->exchange_rate);
            }

            $code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
            if (Session::has('currency_code')) {
                $currency = Currency::where('code', Session::get('currency_code', $code))->first();
            } else {
                $currency = Currency::where('code', $code)->first();
            }

            $price = floatval($price) * floatval($currency->exchange_rate);



            $prices[$key] = format_price($price);
        }
        return $prices;
    }
}




//converts currency to home default currency
if (!function_exists('percent_price')) {
    function percent_price($query, $date, $as)
    {


        $date_yesterday = Carbon::parse($date)->subDays(1)->toDateString();
        $date_today = Carbon::parse($date)->toDateString();


        $product_prices_past = DB::select("$query LIKE  '%$date_yesterday%'
                 ")[0];


        $product_prices_today = DB::select("$query LIKE  '%$date_today%'

                 ")[0];

        $sub_between_24_product_price = doubleval($product_prices_today->{$as}) - doubleval($product_prices_past->{$as});
        $change_per_24_product_price = $sub_between_24_product_price == 0 ? 0 : ($sub_between_24_product_price * 100) / doubleval($product_prices_past->{$as} == 0 ? 1 : $product_prices_past->{$as});

        return $change_per_24_product_price;
    }
}

//convert price from code and price
//converts currency to home default currency
if (!function_exists('convert_price_code')) {
    function convert_price_code($price, $code)
    {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();

        if ($business_settings != null) {
            $currency = Currency::find($business_settings->value);
            $price = floatval($price) / floatval($currency->exchange_rate);
        }

        // $code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        // if(Session::has('currency_code')){
        //     $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        // }
        // else{
        //     $currency = Currency::where('code', $code)->first();
        // }
        $currency = Currency::where('code', $code)->first();

        $price = floatval($price) * floatval($currency->exchange_rate);

        return $price;
    }
}


if (!function_exists('return_price_code')) {
    function return_price_code($price, $code)
    {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();

        if ($business_settings != null) {
            $currency = Currency::find($business_settings->value);
            $price = floatval($price) * floatval($currency->exchange_rate);
        }

        // $code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        // if(Session::has('currency_code')){
        //     $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        // }
        // else{
        //     $currency = Currency::where('code', $code)->first();
        // }
        $currency = Currency::where('code', $code)->first();

        $price = floatval($price) / floatval($currency->exchange_rate);

        return $price;
    }
}



//formats currency
if (!function_exists('format_price')) {
    function format_price($price)
    {
        if (BusinessSetting::where('type', 'decimal_separator')->first()->value == 1) {
            $fomated_price = number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value);
        } else {
            $fomated_price = number_format($price, BusinessSetting::where('type', 'no_of_decimals')->first()->value, ',', ' ');
        }



        if (BusinessSetting::where('type', 'symbol_format')->first()->value == 1) {

            if (\App\Language::where('code', \Session::get('locale', \Config::get('app.locale')))->first()->rtl == 1) {
                return  $fomated_price . " " . translate(currency_symbol());
            }

            return translate(currency_symbol())  . " " . $fomated_price;
        }
        if (\App\Language::where('code', \Session::get('locale', \Config::get('app.locale')))->first()->rtl == 1) {
            return translate(currency_symbol())  . " " . $fomated_price;
        }
        return $fomated_price . " " . translate(currency_symbol());
    }
}

//formats price to home default price with convertion
if (!function_exists('single_price')) {
    function single_price($price)
    {
        return format_price(convert_price($price));
    }
}

//Shows Price on page based on low to high
if (!function_exists('home_price')) {
    function home_price($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if ($lowest_price > $stock->price) {
                    $lowest_price = $stock->price;
                }
                if ($highest_price < $stock->price) {
                    $highest_price = $stock->price;
                }
            }
        }
        if (!empty($product->taxe)) {

            if ($product->taxe->tax_type == 'percent') {
                $lowest_price += ($lowest_price * $product->taxe->tax) / 100;
                $highest_price += ($highest_price * $product->taxe->tax) / 100;
            } elseif ($product->taxe->tax_type == 'amount') {
                $lowest_price += $product->taxe->tax;
                $highest_price += $product->taxe->tax;
            }
        }
        $lowest_price = convert_price($lowest_price);
        $highest_price = convert_price($highest_price);


        if ($lowest_price == $highest_price) {
            return format_price($lowest_price);
        } else {
            return format_price($lowest_price) . ' - ' . format_price($highest_price);
        }
    }
}



//Shows Price on page based on low to high
if (!function_exists('total_price')) {
    function total_price($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if ($lowest_price > $stock->price) {
                    $lowest_price = $stock->price;
                }
                if ($highest_price < $stock->price) {
                    $highest_price = $stock->price;
                }
            }
        }
        if (!empty($product->taxe)) {

            if ($product->taxe->tax_type == 'percent') {
                $lowest_price += ($lowest_price * $product->taxe->tax) / 100;
                $highest_price += ($highest_price * $product->taxe->tax) / 100;
            } elseif ($product->taxe->tax_type == 'amount') {
                $lowest_price += $product->taxe->tax;
                $highest_price += $product->taxe->tax;
            }
        }
        $lowest_price = convert_price($lowest_price);
        $highest_price = convert_price($highest_price);


        return $lowest_price;
    }
}

//Shows Price on page based on low to high with discount
if (!function_exists('home_discounted_price')) {
    function home_discounted_price($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if ($lowest_price > $stock->price) {
                    $lowest_price = $stock->price;
                }
                if ($highest_price < $stock->price) {
                    $highest_price = $stock->price;
                }
            }
        }


        $flash_deal_product = DB::table('flash_deals')
            ->join("flash_deal_products", function ($join) {
                $join->on("flash_deals.id", "=", "flash_deal_products.flash_deal_id");
            })
            ->where("flash_deals.start_date", "<=", strtotime(date('d-m-Y')))
            ->where("flash_deals.end_date", ">=", strtotime(date('d-m-Y')))
            ->where("flash_deals.status", "=", 1)
            ->where("flash_deal_products.product_id", "=", $product->id)
            ->select("flash_deal_products.discount", "flash_deal_products.discount_type")
            ->first();
        $inFlashDeal = false;
        $inSpcialOfferProduct = false;

        if (!empty($flash_deal_product)) {
            if ($flash_deal_product->discount_type == 'percent') {
                $lowest_price -= ($lowest_price * $flash_deal_product->discount) / 100;
                $highest_price -= ($lowest_price * $flash_deal_product->discount) / 100;
            } elseif ($flash_deal_product->discount_type == 'amount') {
                $lowest_price -= $flash_deal_product->discount;
                $highest_price -= $flash_deal_product->discount;
            }
            $inFlashDeal = true;
        }



        if (!$inFlashDeal) {

            if (auth()->check()) {

                $special_offer = new SpcialOffer();
                $discount_lowest_price =   $special_offer->show_special_offer_product($product->id, $lowest_price);
                $discount_highest_price =   $special_offer->show_special_offer_product($product->id, $highest_price);

                if (!empty($discount_lowest_price) && $discount_lowest_price != 0 && !empty($discount_highest_price) && $discount_highest_price != 0) {
                    $lowest_price -= $discount_lowest_price;
                    $highest_price -= $discount_highest_price;
                    $inSpcialOfferProduct = true;
                }
            } else {
                $special_offer = new SpcialOffer();
                $discount_lowest_price =   $special_offer->show_special_offer_product($product->id, $lowest_price);
                $discount_highest_price =   $special_offer->show_special_offer_product($product->id, $highest_price);

                if (!empty($discount_lowest_price) && $discount_lowest_price != 0 && !empty($discount_highest_price) && $discount_highest_price != 0) {
                    $lowest_price -= $discount_lowest_price;
                    $highest_price -= $discount_highest_price;
                    $inSpcialOfferProduct = true;
                }
            }
        }


        if (!$inFlashDeal && !$inSpcialOfferProduct) {

            if (!empty($product->discount_type) && !empty($product->discount)) {

                if ($product->discount_type == 'percent') {
                    $lowest_price -= ($lowest_price * $product->discount) / 100;
                    $highest_price -= ($highest_price * $product->discount) / 100;
                } elseif ($product->discount_type == 'amount') {
                    $lowest_price -= $product->discount;
                    $highest_price -= $product->discount;
                }
            }
        }



        if (!empty($product->taxe)) {
            if ($product->taxe->tax_type == 'percent') {
                $lowest_price += ($lowest_price * $product->taxe->tax) / 100;
                $highest_price += ($highest_price * $product->taxe->tax) / 100;
            } elseif ($product->taxe->tax_type == 'amount') {
                $lowest_price += $product->taxe->tax;
                $highest_price += $product->taxe->tax;
            }
        }


        $lowest_price = convert_price($lowest_price);
        $highest_price = convert_price($highest_price);

        if ($lowest_price == $highest_price) {
            return format_price($lowest_price);
        } else {
            return format_price($lowest_price) . ' - ' . format_price($highest_price);
        }
    }
}

//Shows Base Price
if (!function_exists('home_base_price')) {
    function home_base_price($id)
    {

        $product = DB::table('products')
            ->leftJoin('product_taxes', function ($join) {
                $join->on('products.id', '=', 'product_taxes.product_id');
            })
            ->where("products.id", $id)
            ->select("products.unit_price", "product_taxes.tax", "product_taxes.tax_type")
            ->first();
        $price = $product->unit_price;


        if (!empty($product->tax_type) && !empty($product->tax)) {
            if ($product->tax_type == 'percent') {
                $price += ($price * $product->tax) / 100;
            } elseif ($product->tax_type == 'amount') {
                $price += $product->tax;
            }
        }
        return format_price(convert_price($price));
    }
}

//Shows Base Price with discount
if (!function_exists('home_discounted_base_price')) {

    function home_discounted_base_price($id)
    {
        // $product = Product::findOrFail($id);

        $product = DB::table('products')
            ->leftJoin('product_taxes', function ($join) {
                $join->on('products.id', '=', 'product_taxes.product_id');
            })
            ->where("products.id", $id)
            ->select(
                "products.unit_price",
                "products.discount",
                "products.discount_type",
                "product_taxes.tax",
                "product_taxes.tax_type",
                "products.id"
            )
            ->first();

        $price =   product_discount($product)["price"];

        if (!empty($product->tax_type) && !empty($product->tax)) {
            if ($product->tax_type == 'percent') {
                $price += ($price * $product->tax) / 100;
            } elseif ($product->tax_type == 'amount') {
                $price += $product->tax;
            }
        }




        return format_price(convert_price($price));
    }
}




if (!function_exists('product_discount')) {
    function product_discount($product, $variant_check_price = null)
    {
        $price = !empty($variant_check_price) ? $variant_check_price : $product->unit_price;
        $discount_type = "base";


        $flash_deal_product = DB::table('flash_deals')
            ->join("flash_deal_products", function ($join) {
                $join->on("flash_deals.id", "=", "flash_deal_products.flash_deal_id");
            })
            ->where("flash_deals.start_date", "<=", strtotime(date('d-m-Y')))
            ->where("flash_deals.end_date", ">=", strtotime(date('d-m-Y')))
            ->where("flash_deals.status", "=", 1)
            ->where("flash_deal_products.product_id", "=", $product->id)
            ->select("flash_deal_products.discount", "flash_deal_products.discount_type")
            ->first();
        $inFlashDeal = false;
        $inSpcialOfferProduct = false;

        if (!empty($flash_deal_product)) {
            if ($flash_deal_product->discount_type == 'percent') {
                $discount_amount = ($price * $flash_deal_product->discount) / 100;
                $price -= $discount_amount;
            } elseif ($flash_deal_product->discount_type == 'amount') {
                $discount_amount = $flash_deal_product->discount;

                $price -= $discount_amount;
            }
            $discount_type = "flash_deal";
            $inFlashDeal = true;
        }



        if (!$inFlashDeal) {

            if (auth()->check()) {

                $special_offer = new SpcialOffer();
                $discount =   $special_offer->show_special_offer_product($product->id, $price);
                $discount_amount = $discount;

                if (!empty($discount) && $discount != 0) {
                    $price -= $discount;
                    $inSpcialOfferProduct = true;
                    $discount_type = "spcial_offer";
                }
            } else {

                $special_offer = new SpcialOffer();
                $discount =   $special_offer->show_special_offer_product($product->id, $price);
                if (!empty($discount) && $discount != 0) {
                    $price -= $discount;
                    $inSpcialOfferProduct = true;
                    $discount_type = "spcial_offer";
                }
            }
        }


        if (!$inFlashDeal && !$inSpcialOfferProduct) {
            if (!empty($product->discount_type) && !empty($product->discount)) {

                if ($product->discount_type == 'percent') {
                    $discount_amount = ($price * $product->discount) / 100;
                    $price -= ($price * $product->discount) / 100;
                } elseif ($product->discount_type == 'amount') {
                    $discount_amount = $product->discount;

                    $price -= $product->discount;
                }
            }
        }


        return ["price" => $price, "discount_type" => $discount_type];
    }
}


if (!function_exists('show_product_discount')) {
    function show_product_discount($product, $variant_check_price = null)
    {
        $price = !empty($variant_check_price) ? $variant_check_price : $product->unit_price;
        $discount_type = "base";
        $discount_percent = 0;
        $discount_amount = 0;
        if (!empty($product->taxe->tax_type) && !empty($product->taxe->tax)) {
            if ($product->taxe->tax_type == 'percent') {
                $price += ($price * $product->taxe->tax) / 100;
            } elseif ($product->taxe->tax_type == 'amount') {
                $price += $product->taxe->tax;
            }
        }


        $base_price = $price;

        $flash_deal_product = DB::table('flash_deals')
            ->join("flash_deal_products", function ($join) {
                $join->on("flash_deals.id", "=", "flash_deal_products.flash_deal_id");
            })
            ->where("flash_deals.start_date", "<=", strtotime(date('d-m-Y')))
            ->where("flash_deals.end_date", ">=", strtotime(date('d-m-Y')))
            ->where("flash_deals.status", "=", 1)
            ->where("flash_deal_products.product_id", "=", $product->id)
            ->select("flash_deal_products.discount", "flash_deal_products.discount_type")
            ->first();
        $inFlashDeal = false;
        $inSpcialOfferProduct = false;

        if (!empty($flash_deal_product)) {
            if ($flash_deal_product->discount_type == 'percent') {
                $discount_amount = ($price * $flash_deal_product->discount) / 100;
                $price -= $discount_amount;
            } elseif ($flash_deal_product->discount_type == 'amount') {
                $discount_amount = $flash_deal_product->discount;

                $price -= $discount_amount;
            }
            $discount_type = "flash_deal";
            $inFlashDeal = true;
        }



        if (!$inFlashDeal) {

            if (auth()->check()) {

                $special_offer = new SpcialOffer();
                $discount =   $special_offer->show_special_offer_product($product->id, $price);
                $discount_amount = $discount;

                if (!empty($discount) && $discount != 0) {
                    $price -= $discount;
                    $inSpcialOfferProduct = true;
                    $discount_type = "spcial_offer";
                }
            } else {

                $special_offer = new SpcialOffer();
                $discount =   $special_offer->show_special_offer_product($product->id, $price);
                if (!empty($discount) && $discount != 0) {
                    $price -= $discount;
                    $inSpcialOfferProduct = true;
                    $discount_type = "spcial_offer";
                }
            }
        }


        if (!$inFlashDeal && !$inSpcialOfferProduct) {
            if (!empty($product->discount_type) && !empty($product->discount)) {

                if ($product->discount_type == 'percent') {
                    $discount_amount = ($price * $product->discount) / 100;
                    $price -= ($price * $product->discount) / 100;
                } elseif ($product->discount_type == 'amount') {
                    $discount_amount = $product->discount;

                    $price -= $product->discount;
                }
            }
        }

        $discount_percent = ($discount_amount != 0 ?  ($discount_amount * 100)  / $base_price : 0);

        return ["discount_percent" => round($discount_percent), "discount_amount" => round($discount_amount)];
    }
}

if (!function_exists('currency_symbol')) {
    function currency_symbol()
    {
        $code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        if (Session::has('currency_code')) {
            $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        } else {
            $currency = Currency::where('code', $code)->first();
        }
        return $currency->symbol;
    }
}

if (!function_exists('renderStarRating')) {
    function renderStarRating($rating, $maxRating = 5)
    {
        $fullStar = "<i class = 'las la-star active'></i>";
        $halfStar = "<i class = 'las la-star half'></i>";
        $emptyStar = "<i class = 'las la-star'></i>";
        $rating = $rating <= $maxRating ? $rating : $maxRating;

        $fullStarCount = (int)$rating;
        $halfStarCount = ceil($rating) - $fullStarCount;
        $emptyStarCount = $maxRating - $fullStarCount - $halfStarCount;

        $html = str_repeat($fullStar, $fullStarCount);
        $html .= str_repeat($halfStar, $halfStarCount);
        $html .= str_repeat($emptyStar, $emptyStarCount);
        echo $html;
    }
}
if (!function_exists('style_price')) {
    function style_price($price)
    {
        $html = "<span>" . $price . "</span>";

        echo $html;
    }
}

//Api
if (!function_exists('homeBasePrice')) {
    function homeBasePrice($id)
    {
        $product = Product::findOrFail($id);
        $price = $product->unit_price;

        if (!empty($product->taxe)) {
            if ($product->taxe->tax_type == 'percent') {
                $price += ($price * $product->taxe->tax) / 100;
            } elseif ($product->taxe->tax_type == 'amount') {
                $price += $product->taxe->tax;
            }
        }
        return $price;
    }
}

if (!function_exists('homeDiscountedBasePrice')) {
    function homeDiscountedBasePrice($id)
    {
        $product = Product::findOrFail($id);
        $price = $product->unit_price;

        $flash_deals = FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
                $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
                if ($flash_deal_product->discount_type == 'percent') {
                    $price -= ($price * $flash_deal_product->discount) / 100;
                } elseif ($flash_deal_product->discount_type == 'amount') {
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }

        if (!$inFlashDeal) {
            if ($product->discount_type == 'percent') {
                $price -= ($price * $product->discount) / 100;
            } elseif ($product->discount_type == 'amount') {
                $price -= $product->discount;
            }
        }

        if (!empty($product->taxe)) {
            if ($product->taxe->tax_type == 'percent') {
                $price += ($price * $product->taxe->tax) / 100;
            } elseif ($product->taxe->tax_type == 'amount') {
                $price += $product->taxe->tax;
            }
        }
        return $price;
    }
}

if (!function_exists('homePrice')) {
    function homePrice($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if ($lowest_price > $stock->price) {
                    $lowest_price = $stock->price;
                }
                if ($highest_price < $stock->price) {
                    $highest_price = $stock->price;
                }
            }
        }

        if (!empty($product->taxe)) {

            if ($product->taxe->tax_type == 'percent') {
                $lowest_price += ($lowest_price * $product->taxe->tax) / 100;
                $highest_price += ($highest_price * $product->taxe->tax) / 100;
            } elseif ($product->taxe->tax_type == 'amount') {
                $lowest_price += $product->taxe->tax;
                $highest_price += $product->taxe->tax;
            }
        }

        $lowest_price = convertPrice($lowest_price);
        $highest_price = convertPrice($highest_price);

        return $lowest_price . ' - ' . $highest_price;
    }
}

if (!function_exists('homeDiscountedPrice')) {
    function homeDiscountedPrice($id)
    {
        $product = Product::findOrFail($id);
        $lowest_price = $product->unit_price;
        $highest_price = $product->unit_price;

        if ($product->variant_product) {
            foreach ($product->stocks as $key => $stock) {
                if ($lowest_price > $stock->price) {
                    $lowest_price = $stock->price;
                }
                if ($highest_price < $stock->price) {
                    $highest_price = $stock->price;
                }
            }
        }

        $flash_deals = FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
                $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
                if ($flash_deal_product->discount_type == 'percent') {
                    $lowest_price -= ($lowest_price * $flash_deal_product->discount) / 100;
                    $highest_price -= ($highest_price * $flash_deal_product->discount) / 100;
                } elseif ($flash_deal_product->discount_type == 'amount') {
                    $lowest_price -= $flash_deal_product->discount;
                    $highest_price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }

        if (!$inFlashDeal) {
            if ($product->discount_type == 'percent') {
                $lowest_price -= ($lowest_price * $product->discount) / 100;
                $highest_price -= ($highest_price * $product->discount) / 100;
            } elseif ($product->discount_type == 'amount') {
                $lowest_price -= $product->discount;
                $highest_price -= $product->discount;
            }
        }
        if (!empty($product->taxe)) {

            if ($product->taxe->tax_type == 'percent') {
                $lowest_price += ($lowest_price * $product->taxe->tax) / 100;
                $highest_price += ($highest_price * $product->taxe->tax) / 100;
            } elseif ($product->taxe->tax_type == 'amount') {
                $lowest_price += $product->taxe->tax;
                $highest_price += $product->taxe->tax;
            }
        }
        $lowest_price = convertPrice($lowest_price);
        $highest_price = convertPrice($highest_price);

        return $lowest_price . ' - ' . $highest_price;
    }
}

if (!function_exists('brandsOfCategory')) {
    function brandsOfCategory($category_id)
    {
        $brands = [];
        $subCategories = SubCategory::where('category_id', $category_id)->get();
        foreach ($subCategories as $subCategory) {
            $subSubCategories = SubSubCategory::where('sub_category_id', $subCategory->id)->get();
            foreach ($subSubCategories as $subSubCategory) {
                $brand = json_decode($subSubCategory->brands);
                foreach ($brand as $b) {
                    if (in_array($b, $brands)) continue;
                    array_push($brands, $b);
                }
            }
        }
        return $brands;
    }
}

if (!function_exists('convertPrice')) {
    function convertPrice($price)
    {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if ($business_settings != null) {
            $currency = Currency::find($business_settings->value);
            $price = floatval($price) / floatval($currency->exchange_rate);
        }
        $code = Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        if (Session::has('currency_code')) {
            $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        } else {
            $currency = Currency::where('code', $code)->first();
        }
        $price = floatval($price) * floatval($currency->exchange_rate);
        return $price;
    }
}


function translate($key, $lang = null)
{
    if ($lang == null) {
        $lang = App::getLocale();
    }

    $translation_def = Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->where('lang_key', $key)->first();
    if ($translation_def == null) {
        $translation_def = new Translation;
        $translation_def->lang = env('DEFAULT_LANGUAGE', 'en');
        $translation_def->lang_key = $key;
        $translation_def->lang_value = $key;
        $translation_def->save();
    }

    //Check for session lang
    $translation_locale = Translation::where('lang_key', $key)->where('lang', $lang)->first();
    if ($translation_locale != null && $translation_locale->lang_value != null) {
        return $translation_locale->lang_value;
    } elseif ($translation_def->lang_value != null) {
        return $translation_def->lang_value;
    } else {
        return $key;
    }
}



function translate_data($data, $lang = null)
{
    if ($lang == null) {
        $lang = App::getLocale();
    }

    foreach ($data as $key => $value) {
        $translation_def = Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->where('lang_key', $key)->first();
        if ($translation_def == null) {
            $translation_def = new Translation;
            $translation_def->lang = env('DEFAULT_LANGUAGE', 'en');
            $translation_def->lang_key = $key;
            $translation_def->lang_value = $key;
            $translation_def->save();
        }
        //Check for session lang

        $lang_value_data = "";
        $translation_locale = Translation::where('lang_key', $key)->where('lang', $lang)->first();
        if ($translation_locale != null && $translation_locale->lang_value != null) {
            $lang_value_data =  $translation_locale->lang_value;
        } elseif ($translation_def->lang_value != null) {
            $lang_value_data =  $translation_def->lang_value;
        } else {
            $lang_value_data =  $key;
        }

        $data[$key] = $lang_value_data;
    }


    return $data;
}


function remove_invalid_charcaters($str)
{
    $str = str_ireplace(array("\\"), '', $str);
    return str_ireplace(array('"'), '\"', $str);
}

function getShippingCost($index)
{
    $admin_products = array();
    $seller_products = array();
    $calculate_shipping = 0;

    $carts = Cart::where("user_id", auth()->user()->id)->where("owner_id", Session::get('owner_id'))->get();

    foreach ($carts as $key => $cartItem) {
        $product = \App\Product::find($cartItem['product_id']);
        if ($product->added_by == 'admin') {
            array_push($admin_products, $cartItem['product_id']);
        } else {
            $product_ids = array();
            if (array_key_exists($product->user_id, $seller_products)) {
                $product_ids = $seller_products[$product->user_id];
            }
            array_push($product_ids, $cartItem['product_id']);
            $seller_products[$product->user_id] = $product_ids;
        }
    }

    //Calculate Shipping Cost
    if (get_setting('shipping_type') == 'flat_rate') {
        $calculate_shipping = \App\BusinessSetting::where('type', 'flat_rate_shipping_cost')->first()->value;
    } elseif (get_setting('shipping_type') == 'seller_wise_shipping') {
        if (!empty($admin_products)) {
            $calculate_shipping = \App\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value;
        }
        if (!empty($seller_products)) {
            foreach ($seller_products as $key => $seller_product) {
                $calculate_shipping += \App\Shop::where('user_id', $key)->first()->shipping_cost;
            }
        }
    } elseif (get_setting('shipping_type') == 'area_wise_shipping') {
        $city = City::where('name', Session::get('shipping_info')['city'])->first();
        if ($city != null) {
            $calculate_shipping = $city->cost;
        }
    }

    $cartItem = $carts[$index];
    $product = \App\Product::find($cartItem['product_id']);

    if ($product->digital == 1) {
        return $calculate_shipping = 0;
    }

    if (get_setting('shipping_type') == 'flat_rate') {
        return $calculate_shipping / count($carts);
    } elseif (get_setting('shipping_type') == 'seller_wise_shipping') {
        if ($product->added_by == 'admin') {
            return \App\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value / count($admin_products);
        } else {
            return \App\Shop::where('user_id', $product->user_id)->first()->shipping_cost / count($seller_products[$product->user_id]);
        }
    } elseif (get_setting('shipping_type') == 'area_wise_shipping') {
        if ($product->added_by == 'admin') {
            return $calculate_shipping / count($admin_products);
        } else {
            return $calculate_shipping / count($seller_products[$product->user_id]);
        }
    } else {
        return \App\Product::find($cartItem['product_id'])->shipping_cost;
    }
}

function timezones()
{
    return  array(
        'Pacific/Midway'       => "(GMT-11:00) Midway Island",
        'US/Samoa'             => "(GMT-11:00) Samoa",
        'US/Hawaii'            => "(GMT-10:00) Hawaii",
        'US/Alaska'            => "(GMT-09:00) Alaska",
        'US/Pacific'           => "(GMT-08:00) Pacific Time (US &amp; Canada)",
        'America/Tijuana'      => "(GMT-08:00) Tijuana",
        'US/Arizona'           => "(GMT-07:00) Arizona",
        'US/Mountain'          => "(GMT-07:00) Mountain Time (US &amp; Canada)",
        'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
        'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
        'America/Mexico_City'  => "(GMT-06:00) Mexico City",
        'America/Monterrey'    => "(GMT-06:00) Monterrey",
        'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
        'US/Central'           => "(GMT-06:00) Central Time (US &amp; Canada)",
        'US/Eastern'           => "(GMT-05:00) Eastern Time (US &amp; Canada)",
        'US/East-Indiana'      => "(GMT-05:00) Indiana (East)",
        'America/Bogota'       => "(GMT-05:00) Bogota",
        'America/Lima'         => "(GMT-05:00) Lima",
        'America/Caracas'      => "(GMT-04:30) Caracas",
        'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
        'America/La_Paz'       => "(GMT-04:00) La Paz",
        'America/Santiago'     => "(GMT-04:00) Santiago",
        'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
        'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
        'Greenland'            => "(GMT-03:00) Greenland",
        'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
        'Atlantic/Azores'      => "(GMT-01:00) Azores",
        'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
        'Africa/Casablanca'    => "(GMT) Casablanca",
        'Europe/Dublin'        => "(GMT) Dublin",
        'Europe/Lisbon'        => "(GMT) Lisbon",
        'Europe/London'        => "(GMT) London",
        'Africa/Monrovia'      => "(GMT) Monrovia",
        'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
        'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
        'Europe/Berlin'        => "(GMT+01:00) Berlin",
        'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
        'Europe/Brussels'      => "(GMT+01:00) Brussels",
        'Europe/Budapest'      => "(GMT+01:00) Budapest",
        'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
        'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
        'Europe/Madrid'        => "(GMT+01:00) Madrid",
        'Europe/Paris'         => "(GMT+01:00) Paris",
        'Europe/Prague'        => "(GMT+01:00) Prague",
        'Europe/Rome'          => "(GMT+01:00) Rome",
        'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
        'Europe/Skopje'        => "(GMT+01:00) Skopje",
        'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
        'Europe/Vienna'        => "(GMT+01:00) Vienna",
        'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
        'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
        'Europe/Athens'        => "(GMT+02:00) Athens",
        'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
        'Africa/Cairo'         => "(GMT+02:00) Cairo",
        'Africa/Harare'        => "(GMT+02:00) Harare",
        'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
        'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
        'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
        'Europe/Kiev'          => "(GMT+02:00) Kyiv",
        'Europe/Minsk'         => "(GMT+02:00) Minsk",
        'Europe/Riga'          => "(GMT+02:00) Riga",
        'Europe/Sofia'         => "(GMT+02:00) Sofia",
        'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
        'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
        'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
        'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
        'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
        'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
        'Europe/Moscow'        => "(GMT+03:00) Moscow",
        'Asia/Tehran'          => "(GMT+03:30) Tehran",
        'Asia/Baku'            => "(GMT+04:00) Baku",
        'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
        'Asia/Muscat'          => "(GMT+04:00) Muscat",
        'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
        'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
        'Asia/Kabul'           => "(GMT+04:30) Kabul",
        'Asia/Karachi'         => "(GMT+05:00) Karachi",
        'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
        'Asia/Kolkata'         => "(GMT+05:30) Kolkata",
        'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
        'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
        'Asia/Almaty'          => "(GMT+06:00) Almaty",
        'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
        'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
        'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
        'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
        'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
        'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
        'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
        'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
        'Australia/Perth'      => "(GMT+08:00) Perth",
        'Asia/Singapore'       => "(GMT+08:00) Singapore",
        'Asia/Taipei'          => "(GMT+08:00) Taipei",
        'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
        'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
        'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
        'Asia/Seoul'           => "(GMT+09:00) Seoul",
        'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
        'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
        'Australia/Darwin'     => "(GMT+09:30) Darwin",
        'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
        'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
        'Australia/Canberra'   => "(GMT+10:00) Canberra",
        'Pacific/Guam'         => "(GMT+10:00) Guam",
        'Australia/Hobart'     => "(GMT+10:00) Hobart",
        'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
        'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
        'Australia/Sydney'     => "(GMT+10:00) Sydney",
        'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
        'Asia/Magadan'         => "(GMT+12:00) Magadan",
        'Pacific/Auckland'     => "(GMT+12:00) Auckland",
        'Pacific/Fiji'         => "(GMT+12:00) Fiji",
    );
}

if (!function_exists('app_timezone')) {
    function app_timezone()
    {
        return config('app.timezone');
    }
}

if (!function_exists('api_asset')) {
    function api_asset($id)
    {
        if (($asset = \App\Upload::find($id)) != null) {
            return $asset->file_name;
        }
        return "";
    }
}

//return file uploaded via uploader
if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if (($asset = \App\Upload::find($id)) != null) {
            return my_asset($asset->file_name);
        }
        return null;
    }
}

if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return Storage::disk('s3')->url($path);
        } else {
            return app('url')->asset('public/' . $path, $secure);
        }
    }
}

if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}


if (!function_exists('resources_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function resources_asset($path, $secure = null)
    {
        return app('url')->asset('resources/' . $path, $secure);
    }
}

if (!function_exists('isHttps')) {
    function isHttps()
    {
        return !empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS']);
    }
}

if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = (isHttps() ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}


if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return env('AWS_URL') . '/';
        } else {
            return getBaseURL() . 'public/';
        }
    }
}


if (!function_exists('isUnique')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function isUnique($email)
    {
        $user = \App\User::where('email', $email)->first();

        if ($user == null) {
            return '1'; // $user = null means we did not get any match with the email provided by the user inside the database
        } else {
            return '0';
        }
    }
}

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        $setting = BusinessSetting::where('type', $key)->first();
        return $setting == null ? $default : $setting->value;
    }
}



if (!function_exists('setting_data')) {
    function setting_data($data, $default = null)
    {
        $settings = [];
        foreach ($data as $key => $value) {

            $setting = BusinessSetting::where('type', $key)->first();
            $settings[$key] =  $setting == null ? $default : $setting->value;
        }

        return $settings;
    }
}


if (!function_exists('set_setting_data')) {
    function set_setting_data($data, $default = null)
    {
        $settings = [];
        foreach ($data as $key => $value) {

            $setting = BusinessSetting::where('type', $key)->first();
            $setting->value = $value == null ? "" : $value;
            $setting->save();
            $settings[$key] =  $setting == null ? $default : $setting->value;
        }
        return $settings;
    }
}

if (!function_exists('save_file')) {

    function save_file($file, $folder = '/')
    {
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $fileName = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $dest = public_path('/uploads' . $folder);
        $file->move($dest, $fileName);
        return 'public/uploads' . $folder . '/' . $fileName;
    }
}



if (!function_exists('save_file_install')) {

    function save_file_install($file, $folder = '/')
    {
        $fileName = $file->getClientOriginalName(); // getting image extension

        $dest = base_path($folder);
        $file->move($dest, $fileName);
        return true;
    }
}

function hex2rgba($color, $opacity = false)
{


    return Colorcodeconverter::convertHexToRgba($color, $opacity);
}


function hex2rgb($hex)
{
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        if (Auth::check() && (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff')) {
            return true;
        }
        return false;
    }
}

if (!function_exists('isSeller')) {
    function isSeller()
    {
        if (Auth::check() && Auth::user()->user_type == 'seller') {
            return true;
        }
        return false;
    }
}

if (!function_exists('isCustomer')) {
    function isCustomer()
    {
        if (Auth::check() && Auth::user()->user_type == 'customer') {
            return true;
        }
        return false;
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

// duplicates m$ excel's ceiling function
if (!function_exists('ceiling')) {
    function ceiling($number, $significance = 1)
    {
        return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
    }
}


function contains($needle, $haystack)
{
    return strpos($haystack, $needle) !== false;
}

// if (!function_exists('get_images')) {
//     function get_images($given_ids, $with_trashed = false)
//     {
//         $ids = is_array($given_ids)
//             ? $given_ids
//             : is_null($given_ids) ? [] : explode(",", $given_ids);

//         return $with_trashed
//             ? Upload::withTrashed()->whereIn('id', $ids)->get()
//             : Upload::whereIn('id', $ids)->get();
//     }
// }

//for api
if (!function_exists('get_images_path')) {
    function get_images_path($given_ids, $with_trashed = false)
    {
        $paths = [];
        $images = get_images($given_ids, $with_trashed);
        if (!$images->isEmpty()) {
            foreach ($images as $image) {
                $paths[] = !is_null($image) ? $image->file_name : "";
            }
        }

        return $paths;
    }
}

//for api
if (!function_exists('checkout_done')) {
    function checkout_done($order_id, $payment)
    {
        $order = Order::findOrFail($order_id);
        $order->payment_status = 'paid';
        $order->payment_details = $payment;
        $order->save();

        if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
            $affiliateController = new AffiliateController;
            $affiliateController->processAffiliatePoints($order);
        }

        if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
            if (Auth::check()) {
                $clubpointController = new ClubPointController;
                $clubpointController->processClubPoints($order);
            }
        }
        if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() == null || !\App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated) {
            if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    if ($orderDetail->product->user->user_type == 'seller') {
                        $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price * (100 - $commission_percentage)) / 100 + $orderDetail->tax + $orderDetail->shipping_cost;
                        $seller->save();
                    }
                }
            } else {
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    if ($orderDetail->product->user->user_type == 'seller') {
                        $commission_percentage = $orderDetail->product->category->commision_rate;
                        $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price * (100 - $commission_percentage)) / 100 + $orderDetail->tax + $orderDetail->shipping_cost;
                        $seller->save();
                    }
                }
            }
        } else {
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->payment_status = 'paid';
                $orderDetail->save();
                if ($orderDetail->product->user->user_type == 'seller') {
                    $seller = $orderDetail->product->user->seller;
                    $seller->admin_to_pay = $seller->admin_to_pay + $orderDetail->price + $orderDetail->tax + $orderDetail->shipping_cost;
                    $seller->save();
                }
            }
        }

        $order->commission_calculated = 1;
        $order->save();
    }
}

//special offer calc

//  function calcSpecialOffers($id)
// {
//     $product = Product::findOrFail($id);
//     $lowest_price = $product->unit_price;
//     $highest_price = $product->unit_price;

//     if ($product->variant_product) {
//         foreach ($product->stocks as $key => $stock) {
//             if ($lowest_price > $stock->price) {
//                 $lowest_price = $stock->price;
//             }
//             if ($highest_price < $stock->price) {
//                 $highest_price = $stock->price;
//             }
//         }
//     }


// }

// home_discounted_price($detailedProduct->id)

//for api
if (!function_exists('wallet_payment_done')) {
    function wallet_payment_done($user_id, $amount, $payment_method, $payment_details)
    {
        $user = \App\User::find($user_id);
        $user->balance = $user->balance + $amount;
        $user->save();

        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->amount = $amount;
        $wallet->payment_method = $payment_method;
        $wallet->payment_details = $payment_details;
        $wallet->save();
    }
}

function SMS_Send($phone, $message)
{


    $sms_user = get_setting('PROVIDE_FEKRA_SMS_USERNAME');
    $sms_password = get_setting('PROVIDE_FEKRA_SMS_PASSWORD');
    $sender_name = get_setting('PROVIDE_FEKRA_SMS_SENDER_NAME');
    $message = preg_replace("/\r|\n/", "", $message);
    if ($sms_user != "" && $sms_password != "" && $phone != "" && $message != "") {
        // try {
        // Sending SMS URL
        $url = "http://www.fekra-sms.com/sendsms.php?user=$sms_user&password=$sms_password&numbers=$phone&sender=$sender_name&message=$message&lang=ar";

        $header = array("Accept: application/json");
        $url = str_replace(" ", '%20', $url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
        $retValue = curl_exec($ch);
        $response = json_decode($retValue);
        //return $sending_message = intval($retValue);
        return $response;
        // } catch (Exception $e) {
        // }
    }
    return false;
}

if (!function_exists('customDecrypt')) {

    function customDecrypt($vWord)
    {
        $newEncrypter = new \Illuminate\Encryption\Encrypter(env("ENCRYPT_KEY"), "AES-256-CBC");
        return $newEncrypter->decryptString($vWord);
    }
}



if (!function_exists('getTranslation')) {

    function getTranslation($product_id = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;



        $product_trans = \DB::table('product_translations')
            ->where("product_id", $product_id)
            ->where("lang", $lang)
            ->select("name")
            ->get();

        return count($product_trans) != 0 ? $product_trans[0]->name : null;
    }
}


if (!function_exists('getTranslationCat')) {

    function getTranslationCat($cat_id = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;



        $cat_trans = \DB::table('category_translations')
            ->where("category_id", $cat_id)
            ->where("lang", $lang)
            ->select("name")
            ->get();

        return count($cat_trans) != 0 ? $cat_trans[0]->name : null;
    }
}


if (!function_exists('setCookiess')) {

    function setCookiess($key, $value, $minutes)
    {
        $time = time() + ($minutes * 60);
        setcookie($key, $value, $time);
    }
}

if (!function_exists('getCookiess')) {

    function getCookiess($key)
    {

        if (isset($_COOKIE[$key])) {
            $value = $_COOKIE[$key];
            return $value;
        }

        return null;
    }
}


if (!function_exists('overWriteEnvFile')) {

    function overWriteEnvFile($type, $val)
    {
        if (env('DEMO_MODE') != 'On') {

            $path = base_path('.env');

            if (file_exists($path)) {


                $val = '"' . trim($val) . '"';

                if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                    file_put_contents($path, str_replace(
                        $type . '="' . env($type) . '"',
                        $type . '=' . $val,
                        file_get_contents($path)
                    ));

                    $env_val = env($type);
                    if ($env_val != $val) {
                        file_put_contents($path, str_replace(
                            $type . '=' . env($type),
                            $type . '=' . $val,
                            file_get_contents($path)
                        ));
                    }
                } else {
                    file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
                }
            }
        }
    }
}



if (!function_exists('ip_info')) {

    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {

            $ip = $_SERVER["REMOTE_ADDR"];

            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {

            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
}


if (!function_exists('get_country')) {

    function get_country()
    {
        $country_code =  ip_info("Visitor", "Country Code");
        $country = Country::where("code", $country_code)->first();
        if (!empty($country)) {
            return $country;
        }


        return Country::where("code", "SA")->first();
    }
}


if (!function_exists('get_shipping_country')) {

    function get_shipping_country()
    {
        $country_code =  ip_info("Visitor", "Country Code");
        $country = Country::where("code", $country_code)->first();

        if (empty($country)) {
            $country = Country::where("code", "SA")->first();
        }

        if (count($country->governorates) != 0) {

            $city_cost = \DB::table('cities')
                ->join('governorates', function ($join) {
                    $join->on('governorates.id', '=', 'cities.governorate_id');
                })
                ->join('countries', function ($join) {
                    $join->on('countries.id', '=', 'governorates.country_id');
                })
                ->where("countries.id", $country->id)
                ->select(\DB::raw("MAX(cities.cost) as max_city"), \DB::raw("MIN(cities.cost) as min_city"))
                ->first();

            return ["msg" => translate("done"), "status" => 1, "data" => ["max_cost" => format_price(convert_price($city_cost->max_city)), "min_cost" => format_price(convert_price($city_cost->min_city))]];
        }
        return ["msg" => translate("not found cities to shipping"), "status" => 0];
    }
}


if (!function_exists('products_shipping_days')) {

    function products_shipping_days($products)
    {
        $shipping_days = [];
        foreach ($products as $product) {
            if ($product->est_shipping_days)
                $shipping_days[] =  $product->est_shipping_days;
        }

        $number_shipping_days = 0;
        if (count($shipping_days) != 0) {
            $number_shipping_days = max($shipping_days);
        }

        return $number_shipping_days;
    }
}


if (!function_exists('genRandStr')) {

    function genRandStr()
    {
        $a = $b = '';

        for ($i = 0; $i < 3; $i++) {
            $a .= chr(mt_rand(65, 90)); // see the ascii table why 65 to 90.
            $b .= mt_rand(0, 9);
        }

        return $a . $b;
    }
}

if (!function_exists('fullPhoneUser')) {

    function fullPhoneUser($user)
    {



        if (!empty($user->country_data)) {
            $phone = $user->country_data->tel . $user->phone;
        } else {
            $phone = get_country()->tel . $user->phone;
        }

        return $phone;
    }
}


if (!function_exists('max_cart_product')) {

    function max_cart_product($product, $object, $variant)
    {


        $check = 0;

        if ($object[$variant] != null && $product->variant_product) {
            $product_stock = $product->stocks->where('variant', $object[$variant])->first();
            $quantity = $product_stock->qty;
            if ($quantity >= $object["quantity"]) {
            } else {
                $check = 1;
            }
        } elseif ($product->current_stock == $object["quantity"]) {
            $check = 1;
        } elseif ($product->current_stock < $object["quantity"]) {
            $check = 1;
        }

        return $check;
    }
}



if (!function_exists('put_setting')) {

    function put_setting($type, $value)
    {



        $business_settings = new BusinessSetting();
        $business_settings->type = $type;
        $business_settings->value = $value;
        $business_settings->save();
    }
}

if (!function_exists('create_objsects_general_transes')) {

    function create_objsects_general_transes($table_name, $obj_id, $column_name, $value)
    {
        $langs =  Language::all();



        foreach ($langs as $lang) {
            $general_trans =  GeneralTranslation::where("row_id", $obj_id)
                ->where("table_name", $table_name)
                ->where("column_name", $column_name)
                ->where("lang", $lang->code)
                ->first();
            if (!empty($general_trans)) {
                $general_trans->trans  = $value;
                $general_trans->save();
            } else {
                $general_trans = new GeneralTranslation();
                $general_trans->table_name   = $table_name;
                $general_trans->lang          = $lang->code;
                $general_trans->row_id     = $obj_id;
                $general_trans->column_name   = $column_name;
                $general_trans->trans         = $value;

                $general_trans->save();
            }
        }
        return "done";
    }
}



if (!function_exists('delete_objsects_general_transes')) {

    function delete_objsects_general_transes($table_name, $obj_id, $column_name, $value)
    {
        $langs =  Language::all();



        foreach ($langs as $lang) {
            $general_trans =  GeneralTranslation::where("row_id", $obj_id)
                ->where("table_name", $table_name)
                ->where("column_name", $column_name)
                ->where("lang", $lang->code)
                ->first();
            if (!empty($general_trans)) {
                $general_trans->delete();
            }
        }
        return "done";
    }
}


function get_general_trans($table_name, $obj_id, $column_name)
{

    $lang = Session::get('locale', Config::get('app.locale'));
    $general_trans =  GeneralTranslation::where("row_id", $obj_id)
        ->where("table_name", $table_name)
        ->where("column_name", $column_name)
        ->where("lang", $lang)
        ->first();
    if (!empty($general_trans)) {

        return   $general_trans->trans;
    }

    return null;
}




if (!function_exists('dir_lang')) {

    function dir_lang()
    {
        $lang_code =  Session::get('locale', Config::get('app.locale'));
        $lang =  Language::where("code", $lang_code)->first();
        if (!empty($lang)) {
            return $lang->rtl == 1 ? "rtl" : "ltr";
        }
        return "ltr";
    }
}

if (!function_exists('defualt_img')) {
    function defualt_img()
    {
        return url("/") . "assets/img/placeholder.jpg";
    }
}


if (!function_exists('photo')) {
    function photo($photo_id)
    {
        return  !empty(Upload::find($photo_id)) ? static_asset(Upload::find($photo_id)->file_name) : defualt_img();
    }
}


if (!function_exists('hash_role')) {
    function hash_role($role_id)
    {
        return  "?role_id=" . encrypt($role_id);
    }
}

if (!function_exists('put_values_attr')) {
    function put_values_attr($attr_id)
    {
        $attr = Attribute::find($attr_id);
        $text = "";
        foreach ($attr->values as $item) {
            if ($text == "") {
                $text =  $item->value;
            } else {
                $text .= ',' . $item->value;
            }
        }

        return $text;
    }
}
if (!function_exists('hash_role_route')) {
    function hash_role_route($role_id)
    {
        return  ["role_id" => encrypt($role_id)];
    }
}
