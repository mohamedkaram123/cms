<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\CommissionHistory;
use App\Models\Order;
use App\Review;
use App\Wallet;
use App\Seller;
use App\User;
use App\Search;
use App\Upload;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\MyClasses\Search as MyClassesSearch;

class ReportController extends Controller
{
    public function stock_report(Request $request)
    {
        $sort_by = null;
        $products = Product::orderBy('created_at', 'desc');
        if ($request->has('category_id')) {
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        $products = $products->paginate(15);
        return view('backend.reports.stock_report', compact('products', 'sort_by'));
    }

    public function in_house_sale_report(Request $request)
    {
        $sort_by = null;
        $products = Product::orderBy('num_of_sale', 'desc')->where('added_by', 'admin');
        if ($request->has('category_id')) {
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        $products = $products->paginate(15);
        return view('backend.reports.in_house_sale_report', compact('products', 'sort_by'));
    }

    public function seller_sale_report(Request $request)
    {
        $sort_by = null;
        $sellers = Seller::orderBy('created_at', 'desc');
        if ($request->has('verification_status')) {
            $sort_by = $request->verification_status;
            $sellers = $sellers->where('verification_status', $sort_by);
        }
        $sellers = $sellers->paginate(10);
        return view('backend.reports.seller_sale_report', compact('sellers', 'sort_by'));
    }

    public function wish_report(Request $request)
    {
        $sort_by = null;
        $arrange_type = $request->has("arrange_type") && $request->arrange_type != "" ? $request->arrange_type : "desc";

        $products = Product::orderBy('created_at', $arrange_type);

        if ($request->has('date_from') && $request->has('date_to') && $request->date_from != "" && $request->date_to != "") {
            $products = $products->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }
        if ($request->has('category_id') && $request->category_id  != "") {
            $sort_by = $request->category_id;
            $products = $products->where('category_id', $sort_by);
        }
        $products = $products->paginate(10);
        return view('backend.reports.wish_report', compact('products', 'sort_by'));
    }

    public function user_search_report(Request $request)
    {
        $searches = Search::orderBy('count', 'desc')->paginate(10);
        return view('backend.reports.user_search_report', compact('searches'));
    }

    public function commission_history(Request $request)
    {
        $seller_id = null;
        $date_range = null;

        if (Auth::user()->user_type == 'seller') {
            $seller_id = $request->seller_id;
        }
        if ($request->seller_id) {
            $seller_id = $request->seller_id;
        }

        $commission_history = CommissionHistory::orderBy('created_at', 'desc');

        if ($request->date_range) {
            $date_range = $request->date_range;
            $date_range1 = explode(" / ", $request->date_range);
            $commission_history = $commission_history->where('created_at', '>=', $date_range1[0]);
            $commission_history = $commission_history->where('created_at', '<=', $date_range1[1]);
        }
        if ($seller_id) {

            $commission_history = $commission_history->where('seller_id', '=', $seller_id);
        }

        $commission_history = $commission_history->paginate(10);
        if (Auth::user()->user_type == 'seller') {
            return view('frontend.user.seller.reports.commission_history_report', compact('commission_history', 'seller_id', 'date_range'));
        }
        return view('backend.reports.commission_history_report', compact('commission_history', 'seller_id', 'date_range'));
    }

    public function wallet_transaction_history(Request $request)
    {
        $user_id = null;
        $date_range = null;

        if ($request->user_id) {
            $user_id = $request->user_id;
        }

        $users_with_wallet = User::whereIn('id', function ($query) {
            $query->select('user_id')->from(with(new Wallet)->getTable());
        })->get();

        $wallet_history = Wallet::orderBy('created_at', 'desc');

        if ($request->date_range) {
            $date_range = $request->date_range;
            $date_range1 = explode(" / ", $request->date_range);
            $wallet_history = $wallet_history->where('created_at', '>=', $date_range1[0]);
            $wallet_history = $wallet_history->where('created_at', '<=', $date_range1[1]);
        }
        if ($user_id) {
            $wallet_history = $wallet_history->where('user_id', '=', $user_id);
        }

        $wallets = $wallet_history->paginate(10);

        return view('backend.reports.wallet_history_report', compact('wallets', 'users_with_wallet', 'user_id', 'date_range'));
    }


    public function main_report(Request $request)
    {

        return view("backend.reports.main_reports");
    }
    public function main_report_sales(Request $request)
    {



        $sales_now = DB::select("SELECT SUM(orders.grand_total) AS grand_total ,  SUM(orders.shipping_cost) AS shipping_cost FROM orders WHERE created_at >= '$request->from'  AND created_at <= '$request->to' ");
        $taxes_and_shipping_cost = DB::select("SELECT SUM(order_details.tax) AS taxes from order_details where created_at >=  '$request->from' AND created_at <=  '$request->to' AND payment_status = 'paid' ");
        $sales_elec_pay = DB::select("SELECT SUM(orders.grand_total) AS total from orders where created_at >=  '$request->from' AND created_at <=  '$request->to' AND payment_status = 'paid' AND payment_type != 'wallet' AND payment_type != 'cash_on_delivery' ");
        $sales = DB::select("SELECT COUNT(orders.id) AS
                             value,orders.created_at AS year
                             FROM orders
                             WHERE created_at >= '$request->from'  AND created_at <= '$request->to'
                             GROUP BY  DAY(created_at) ");


        $product_prices = DB::select("SELECT
                    SUM(order_details.price) + SUM(products.discount *  order_details.quantity )
                        AS sumPrice , SUM(products.discount *  order_details.quantity ) AS discounts
                        FROM order_details
                        INNER JOIN products
                        ON order_details.product_id = products.id
                    AND
                    order_details.created_at >= '$request->from'
                    AND
                    order_details.created_at <= '$request->to'
                 ")[0];

        $carts = DB::select("SELECT ( SUM(price) / COUNT(id) ) AS avgPrice ,MIN(price) AS minPrice,MAX(price) AS maxPrice
                             from carts
                            WHERE
                            carts.created_at >= '$request->from'
                            AND
                            carts.created_at <= '$request->to'
                               ")[0];

        return  response()->json([

            "sales_now" => format_price($sales_now[0]->grand_total),

            "change_per_24" => doubleval(0),
            "taxes" => format_price($taxes_and_shipping_cost[0]->taxes),
            "shipping_cost" => format_price($sales_now[0]->shipping_cost),

            "sales_elec_pay" => format_price($sales_elec_pay[0]->total),
            "product_prices" => format_price($product_prices->sumPrice),
            "change_per_24_product_price" => doubleval(0),

            "discount" => format_price($product_prices->discounts),
            "change_per_24_product_discount" => doubleval(0),
            "sales_chart" => $sales,
            "data_avg_carts" => $carts,
            "avgPrice" => format_price($carts->avgPrice)



        ]);
    }



    public function main_report_products(Request $request)
    {


        $top_12_products = DB::select("SELECT name, num_of_sale,slug,photos
                                        FROM products WHERE products.published = 1
                                        AND
                                        products.created_at >= '$request->from'
                                        AND
                                        products.created_at <= '$request->to'
                                        ORDER By products.num_of_sale DESC LIMIT 12");

        $products = collect($top_12_products)->map(function ($product) {

            $product->photos =  !empty($product->photos) ? url("/public") . "/" . Upload::find($product->photos)->file_name : null;
            $product->slug = url("/product") . "/" . $product->slug;

            return $product;
        });



        return response()->json([
            "products" => $products
        ]);
    }


    public function abandoned_baskets(Request $request)
    {


        $carts_baskets = DB::select("SELECT SUM(carts.price) AS prices,
                                      users.name,
                                      users.phone,
                                      carts.created_at AS created_at,
                                      SUM(carts.quantity) AS quantity,
                                      products.name AS product_name,
                                      products.slug
                                       FROM carts
                                       INNER JOIN users ON users.id = carts.user_id
                                       INNER JOIN products ON products.id = carts.product_id
                                        WHERE
                                        carts.created_at >= '$request->from'
                                        AND
                                        carts.created_at <= '$request->to'
                                       GROUP BY users.name
                                       ORDER BY prices DESC");



        return response()->json([
            "abandoned_baskets" => $carts_baskets
        ]);
    }


    public function sales_products(Request $request)
    {
        $number_product_sales = DB::select("SELECT SUM(quantity) AS quantity
                                            from order_details
                                            WHERE
                                            order_details.created_at >= '$request->from'
                                            AND
                                            order_details.created_at <= '$request->to'
                                            ");
        $price_product_sales = DB::select("SELECT SUM(grand_total) AS grand_total
                                          from orders
                                          WHERE
                                          orders.created_at >= '$request->from'
                                           AND
                                          orders.created_at <= '$request->to'
                                          ");

        $top_12_products = DB::select("SELECT name, num_of_sale,slug,photos
                                        FROM products WHERE products.published = 1
                                        AND
                                        products.created_at >= '$request->from'
                                        AND
                                        products.created_at <= '$request->to'
                                        ORDER By products.num_of_sale DESC LIMIT 12");

        $products = collect($top_12_products)->map(function ($product) {

            $product->photos =  !empty($product->photos) ? url("/public") . "/" . Upload::find($product->photos)->file_name : null;
            $product->slug = url("/product") . "/" . $product->slug;

            return $product;
        });

        return response()->json([
            "number_product_sales" => $number_product_sales[0]->quantity,
            "price_product_sales" => format_price($price_product_sales[0]->grand_total),
            "products" => $products

        ]);
    }


    public function all_brands_products_sale(Request $request)
    {
        $brands = DB::select("SELECT SUM(products.num_of_sale) AS number ,
                                            brands.name from brands
                                            JOIN products ON products.brand_id = brands.id
                                            JOIN order_details ON order_details.product_id = products.id
                                            WHERE
                                            order_details.created_at >= '$request->from'
                                            AND
                                            order_details.created_at <= '$request->to'
                                            GROUP BY brands.name
                                            ORDER BY number ASC
                                            ");
        return response()->json([
            "brands" => $brands,
        ]);
    }

    public function all_categories_products_sale(Request $request)
    {
        $categories = DB::select("SELECT SUM(products.num_of_sale) AS number ,
                                            categories.name from categories
                                            JOIN products ON products.category_id = categories.id
                                            JOIN order_details ON order_details.product_id = products.id
                                            WHERE
                                            order_details.created_at >= '$request->from'
                                            AND
                                            order_details.created_at <= '$request->to'
                                            GROUP BY categories.name
                                            ORDER BY number ASC
                                            ");
        return response()->json([
            "categories" => $categories,
        ]);
    }

    public function sales_coupons_data(Request $request)
    {

        $total_discount_amount = DB::select("SELECT SUM(coupons.discount) AS discount_amount FROM `coupon_usages`
                                             JOIN coupons ON coupons.id = coupon_usages.coupon_id
                                              WHERE coupons.type = 'product_base'
                                              AND coupons.discount_type = 'amount'
                                              AND coupon_usages.created_at >= '$request->from'
                                              AND coupon_usages.created_at <= '$request->to'
                                               ");

        $total_discount_percent = DB::select("SELECT SUM(coupons.discount) AS discount_percent FROM `coupon_usages`
                                             JOIN coupons ON coupons.id = coupon_usages.coupon_id
                                              WHERE coupons.type = 'product_base'
                                              AND coupons.discount_type = 'percent'
                                              AND coupon_usages.created_at >= '$request->from'
                                              AND coupon_usages.created_at <= '$request->to'
                                               ");

        $total_coupons_usage = DB::select("SELECT COUNT(coupon_usages.id) AS total_coupons_usage
                                           FROM `coupon_usages`
                                           Where  coupon_usages.created_at >= '$request->from'
                                              AND coupon_usages.created_at <= '$request->to'
                                           ");


        $coupons_chart_data = DB::select("SELECT coupons.code AS code , COUNT(coupon_usages.id) AS number
                                         FROM coupons
                                        JOIN coupon_usages ON coupon_usages.coupon_id = coupons.id
                                        WHERE coupons.type = 'product_base'
                                        AND  coupon_usages.created_at >= '$request->from'
                                        AND coupon_usages.created_at <= '$request->to'
                                        GROUP BY coupons.code
                                        ORDER BY number ASC

                                           ");





        return response()->json([
            "total_discount_amount" => format_price($total_discount_amount[0]->discount_amount),
            "total_discount_percent" => $total_discount_percent[0]->discount_percent != 0 ? $total_discount_percent[0]->discount_percent . "%" : 0,
            "total_coupons_usage" => $total_coupons_usage[0]->total_coupons_usage,
            "coupons_chart_data" => $coupons_chart_data

        ]);
    }


    public function main_report_customers(Request $request)
    {

        $symbol = currency_symbol();

        $reviews = DB::select("SELECT COUNT(reviews.id) AS `count` , reviews.rating
                                FROM reviews
                                WHERE  reviews.created_at >= '$request->from'
                                AND reviews.created_at <= '$request->to'
                                GROUP BY reviews.rating
                                ORDER BY `count` DESC");





        $counts_numbers = 0;

        foreach ($reviews as $item) {
            $counts_numbers += $item->count;
        }

        $data_reviews = collect($reviews)->map(function ($item) use ($counts_numbers) {
            if ($item->rating == 5) {
                $item->item = translate("fully satisfied");
            } elseif ($item->rating == 4) {
                $item->item = translate("slightly satisfied");
            } elseif ($item->rating == 3) {
                $item->item = translate("satisfied");
            } elseif ($item->rating == 2) {
                $item->item = translate("not satisfied");
            } elseif ($item->rating == 1) {
                $item->item = translate("angry");
            }

            $percent = ((int)$item->count / $counts_numbers);
            $item->percent = $percent;
            return $item;
        });

        $customers_sales =  DB::select("SELECT COUNT(users.id) AS customers_sales FROM users
                                   JOIN orders ON orders.user_id = users.id
                                   WHERE users.user_type = 'customer'
                                   AND  orders.created_at >= '$request->from'
                                    AND orders.created_at <= '$request->to'
                                    ");

        $customers =  DB::select("SELECT COUNT(users.id) AS customers FROM users
                                    WHERE users.user_type = 'customer'
                                     AND  users.created_at >= '$request->from'
                                    AND users.created_at <= '$request->to'
                                    ");
        $customers_sales_price =  DB::select("SELECT concat('$symbol',SUM(orders.grand_total))  AS total_price , users.name
                                             FROM users
                                             JOIN orders ON orders.user_id = users.id
                                             WHERE users.user_type = 'customer'
                                              AND  orders.created_at >= '$request->from'
                                              AND orders.created_at <= '$request->to'
                                             GROUP BY users.name
                                             ORDER BY total_price
                                             DESC LIMIT 20");








        return  response()->json([
            "reviews" => $data_reviews,
            "customers_sales" => $customers_sales[0]->customers_sales,
            "customers_not_sales" => (int)$customers[0]->customers - (int)$customers_sales[0]->customers_sales,
            "customers_sales_price" => $customers_sales_price,



        ]);
    }

    public function main_report_sellers(Request $request)
    {


        $sellers_active = User::where("user_type", "seller")->where("email_verified_at", "!=", null)->whereBetween('created_at', [$request->from, $request->to])
            ->get();
        $sellers_not_active = User::where("user_type", "seller")->where("email_verified_at", "=", null)->whereBetween('created_at', [$request->from, $request->to])
            ->get();




        $orders = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->whereBetween('users.created_at', [$request->from, $request->to])
            ->where("users.user_type", "=", "seller")
            ->select("*")
            ->get();



        $prices = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')

            ->whereBetween('users.created_at', [$request->from, $request->to])
            ->where("users.user_type", "=", "seller")
            ->sum("order_details.price");



        return  response()->json([
            "sellers_active" => count($sellers_active),
            "sellers_not_active" => count($sellers_not_active),
            "sellers_orders" => count($orders),
            "seller_prices" => $prices,



        ]);
    }

    public function main_report_visits(Request $request)
    {


        $admins = DB::table('activities')
            ->whereBetween('activities.created_at', [$request->from, $request->to])
            ->where("log_id", "=", 1101)
            ->where("user_type", "=", "admin")

            ->select("*")
            ->get();



        $guests = DB::table('activities')
            ->whereBetween('activities.created_at', [$request->from, $request->to])
            ->where("log_id", "=", 1101)
            ->where("user_type", "=", "guest")

            ->select("*")
            ->get();




        $customers = DB::table('activities')
            ->whereBetween('activities.created_at', [$request->from, $request->to])
            ->where("log_id", "=", 1101)
            ->where("user_type", "=", "customer")

            ->select("*")
            ->get();




        $sellers = DB::table('activities')
            ->whereBetween('activities.created_at', [$request->from, $request->to])
            ->where("log_id", "=", 1101)
            ->where("user_type", "=", "seller")

            ->select("*")
            ->get();




        return  response()->json([
            "admins_visits" => count($admins),
            "guests_visits" => count($guests),
            "customers_visits" => count($customers),
            "sellers_visits" => count($sellers),



        ]);
    }


    public function main_report_orders(Request $request)
    {



        $dates = DB::select("SELECT COUNT(orders.id) AS value,orders.created_at AS year
                            FROM orders
                            WHERE  orders.created_at >= '$request->from'
                            AND orders.created_at <= '$request->to'
                            GROUP BY WEEK(created_at)");


        $weekMap = [
            0 => translate("Sunday"),
            1 => translate("Monday"),
            2 => translate("Tuesday"),
            3 => translate("Wednesday"),
            4 => translate("Thursday"),
            5 => translate("Friday"),
            6 => translate("Saterday"),
        ];

        foreach ($dates as $date) {
            $dayOfTheWeek =  Carbon::parse($date->year)->dayOfWeek;
            $weekday = $weekMap[$dayOfTheWeek];

            $date->year  = $weekday;
        }



        $dates_orders_hours = DB::select("SELECT COUNT(orders.id) AS value,orders.created_at AS `type`
                                          FROM orders
                                          WHERE  orders.created_at >= '$request->from'
                                          AND orders.created_at <= '$request->to'
                                          GROUP BY HOUR(created_at)");




        foreach ($dates_orders_hours as $item) {
            $date_time =  Carbon::parse($item->type);
            $date = new Carbon($date_time);


            // $date->format('g:i A');
            $item->type  = $date->format('g:i A');
        }

        $users = DB::select("SELECT COUNT(orders.id) AS orders_count ,users.name
                                          FROM orders
                                          JOIN users ON users.id = orders.user_id
                                          WHERE  orders.created_at >= '$request->from'
                                          AND orders.created_at <= '$request->to'
                                          GROUP BY users.id
                                          ORDER BY orders_count
                                          DESC LIMIT 20");




        // return $reviews;
        return  response()->json([
            "dates_orders_hours" => $dates_orders_hours,
            "dates" => $dates,
            "users" => $users

        ]);
    }
    
    
    
    public function searches()
    {
        $products = MyClassesSearch::get_top_10_products_search();
        $categories = MyClassesSearch::get_top_10_categories_search();

        return  response()->json([
            "products" => $products,
            "categories" => $categories,


        ]);
    }
}
