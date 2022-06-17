<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewerOrderController extends Controller
{
    public function index(Request $request, $order_search = 0)
    {

        // $sellersCarts = [];
        // $cartsData = [];
        // $carts = Cart::where("order_admin", auth()->user()->id)->get();

        // if (count($carts) != 0) {
        //     $sellerIds = [];
        //     foreach ($carts as $item) {

        //         $sellerIds[] = $item["owner_id"];
        //     }




        //     if (count($sellerIds) != 0) {
        //         foreach (array_unique($sellerIds) as $seller_id) {
        //             $cartsSeller = [];
        //             $user = User::where("id", $seller_id)->where("user_type", "seller")->first();
        //             foreach ($carts as $cart) {
        //                 if ($seller_id == $cart["owner_id"]) {
        //                     $cartsSeller[] = $cart;
        //                 }
        //             }
        //             $user["carts"] = $cartsSeller;


        //             $sellersCarts[] = $user;
        //         }

        //         //  return $sellersCarts;
        //         foreach ($sellersCarts as $seller) {
        //             $price = 0;

        //             foreach ($seller["carts"] as $item) {
        //                 $price += ($item["price"] + $item["shipping_cost"] + $item["tax"]) * $item["quantity"];
        //                 $item["product_name"] = !empty(Product::find($item["product_id"])) ? Product::find($item["product_id"])->name : null;
        //             }
        //             $seller["price"] = $price;
        //             $cartsData[] = $seller;
        //             // return $seller;

        //         }
        //     }
        // }


        // if (session()->has("admin_order_id")) {
        //     // return dd(session()->has("admin_order_id"));

        //     $order = new OrderController();
        //     $order->destroy(session()->get("admin_order_id"));
        // }
        // session()->forget('admin_order_id');


        return view("backend.sales.new_orders.index", ["cartsData" => [], "search" => $request->search, "order_search" => $request->order_search]);
    }

    public function all_orders(Request $request)
    {


        $orders = DB::table('orders');
        $symbol = currency_symbol();

        $date = null;
        $sort_search = null;

        if ($request->search != "null") {

            $orders_data = [];

            if (is_numeric($request->search)) {

                $orders = $orders
                    ->where('code', 'like', '%' . $request->search . '%')
                    ->orWhere('id', 'like', '%' . $request->search . '%')
                    ->join('users', function ($join) {
                        $join->on('users.id', '=', 'orders.user_id')
                            ->where('users.user_type', '=', 'admin')
                            ->orOn('users.id', '=', 'orders.user_id')
                            ->where('users.user_type', '=', 'customer');
                    })

                    ->select('orders.delivery_status', 'orders.payment_status', 'orders.id', 'orders.code', 'orders.created_at', DB::raw("CONCAT('$symbol', orders.grand_total) AS grand_total"), 'users.name as customer')
                    ->orderBy("id", "desc")
                    ->get();
            } else if (preg_match('/\d{8}-\d{8}/', $request->search)) {

                $orders = $orders
                    ->where('code', 'like', '%' . $request->search . '%')
                    ->join('users', function ($join) {
                        $join->on('users.id', '=', 'orders.user_id')
                            ->where('users.user_type', '=', 'admin')
                            ->orOn('users.id', '=', 'orders.user_id')
                            ->where('users.user_type', '=', 'customer');
                    })

                    ->select('orders.delivery_status', 'orders.payment_status', 'orders.id', 'orders.code', 'orders.created_at', DB::raw("CONCAT('$symbol', orders.grand_total) AS grand_total"), 'users.name as customer')
                    ->orderBy("id", "desc")
                    ->get();
            } else {
                $orders = $orders
                    ->join('users', function ($join) {
                        $join->on('users.id', '=', 'orders.user_id')
                            ->where('users.user_type', '=', 'admin')
                            ->orOn('users.id', '=', 'orders.user_id')
                            ->where('users.user_type', '=', 'customer');
                    })

                    ->select('orders.delivery_status', 'orders.payment_status', 'orders.id', 'orders.code', 'orders.created_at', DB::raw("CONCAT('$symbol', orders.grand_total) AS grand_total"), 'users.name as customer')
                    ->where('users.name', 'like', '%' . $request->search . '%')
                    ->orderBy("id", "desc")
                    ->get();
            }
        } else {

            // $pagination = $request->paginate != -1 ? "limit 10 offset $request->paginate" : "limit 100000";
            // $orders =
            $orders =  DB::table('orders')
                ->join('users', function ($join) {
                    $join->on('users.id', '=', 'orders.user_id')
                        ->where('users.user_type', '=', 'admin')
                        ->orOn('users.id', '=', 'orders.user_id')
                        ->where('users.user_type', '=', 'customer');
                })
                ->orderBy("id", "desc")
                ->select('orders.delivery_status', 'orders.payment_status', 'orders.id', 'orders.code', 'orders.created_at', DB::raw("CONCAT('$symbol', orders.grand_total) AS grand_total"), 'users.name as customer')
                ->limit(100000)->get();
        }

        // $orders = collect($orders)->map(function ($item) {
        //     $item->grand_total = single_price($item->grand_total);
        //     return $item;
        // });

        return response()->json([
            "orders" => $orders
        ]);
    }


    public function search_orders(Request $request)
    {
        $symbol = currency_symbol();


        $query =  DB::table('orders')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'orders.user_id')
                    ->where('users.user_type', '=', 'admin')
                    ->orOn('users.id', '=', 'orders.user_id')
                    ->where('users.user_type', '=', 'customer');
            })

            ->select('orders.delivery_status', 'orders.payment_status', 'orders.id', 'orders.code', 'orders.created_at', DB::raw("CONCAT('$symbol', orders.grand_total) AS grand_total"), 'users.name as customer')

            ->whereBetween('orders.created_at', [$request->startDate, $request->endDate]);


        if ($request->id != 0 && $request->id != null) {
            $query =    $query->where("orders.id", 'like', "%$request->id%");
        }
        if ($request->grand_total != 0 && $request->grand_total != null) {
            $query =    $query->where("orders.grand_total", 'like', "%$request->id%");
        }

        if ($request->delivery_status != "") {
            $query =    $query->where("orders.delivery_status", $request->delivery_status);
        }
        if ($request->payment_status != "") {
            $query =    $query->where("orders.payment_status", $request->payment_status);
        }
        if ($request->code != "") {
            $query =    $query->where("orders.code", 'like', "%$request->code%");
        }


        if ($request->customer != "") {
            $query =    $query->where("users.name", 'like', "%$request->customer%");
        }
        $orders = $query
            ->orderBy("orders.id", "desc")
            ->get();

        // if ($request->id != 0) {
        //     $query->where("orders.id", $request->id);
        // }
        // $orders = $query->get();

        return response()->json([
            "orders" => $orders
        ]);
    }


    public function sellersData()
    {

        $sellersCarts = [];
        $cartsData = [];
        $carts = Cart::where("order_admin", auth()->user()->id)->get();

        if (count($carts) != 0) {
            $sellerIds = [];
            foreach ($carts as $item) {

                $sellerIds[] = $item["owner_id"];
            }




            if (count($sellerIds) != 0) {
                foreach (array_unique($sellerIds) as $seller_id) {
                    $cartsSeller = [];
                    $user = User::where("id", $seller_id)->where("user_type", "seller")->first();
                    foreach ($carts as $cart) {
                        if ($seller_id == $cart["owner_id"]) {
                            $cartsSeller[] = $cart;
                        }
                    }
                    $user["carts"] = $cartsSeller;


                    $sellersCarts[] = $user;
                }

                //  return $sellersCarts;
                foreach ($sellersCarts as $seller) {
                    $price = 0;

                    foreach ($seller["carts"] as $item) {
                        $price += ($item["price"] + $item["shipping_cost"] + $item["tax"]) * $item["quantity"];
                        $item["product_name"] = !empty(Product::find($item["product_id"])) ? Product::find($item["product_id"])->name : null;
                    }
                    $seller["price"] = $price;
                    $cartsData[] = $seller;
                    // return $seller;

                }
            }
        }

        return $cartsData;
    }

    public function new_order(Request $request)
    {



        $sellersCarts = [];
        $cartsData = [];
        $carts = Cart::where("order_admin", auth()->user()->id)->get();

        if (count($carts) != 0) {
            $sellerIds = [];
            foreach ($carts as $item) {

                $sellerIds[] = $item["owner_id"];
            }




            if (count($sellerIds) != 0) {
                foreach (array_unique($sellerIds) as $seller_id) {
                    $cartsSeller = [];
                    $user = User::where("id", $seller_id)->where("user_type", "seller")->first();
                    foreach ($carts as $cart) {
                        if ($seller_id == $cart["owner_id"]) {
                            $cartsSeller[] = $cart;
                        }
                    }
                    $user["carts"] = $cartsSeller;


                    $sellersCarts[] = $user;
                }

                //  return $sellersCarts;
                foreach ($sellersCarts as $seller) {
                    $price = 0;

                    foreach ($seller["carts"] as $item) {
                        $price += ($item["price"] + $item["shipping_cost"] + $item["tax"]) * $item["quantity"];
                        $item["product_name"] = !empty(Product::find($item["product_id"])) ? Product::find($item["product_id"])->name : null;
                    }
                    $seller["price"] = $price;
                    $cartsData[] = $seller;
                    // return $seller;

                }
            }
        }


        if (session()->has("admin_order_id")) {
            // return dd(session()->has("admin_order_id"));

            $order = new OrderController();
            $order->destroy(session()->get("admin_order_id"));
        }
        session()->forget('admin_order_id');

        // return $cartsData;
        return view("backend.sales.new_orders.new_order", ["cartsData" => $cartsData]);
        // $cartsArr =  json_encode($cartsData);
    }



    public function orders_data(Request $request)
    {
        $symbol = currency_symbol();



        $query =  DB::table('orders')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'orders.user_id')
                    ->where('users.user_type', '=', 'admin')
                    ->orOn('users.id', '=', 'orders.user_id')
                    ->where('users.user_type', '=', 'customer');
            });


        if ($request->id != 0 && $request->id != null || $request->search != "") {
            if ($request->id != 0 && $request->id != null) {
                $query =    $query->where("orders.id", 'like', "%$request->id%");
            } else if ($request->search != "" && is_numeric($request->search)) {
                $query =    $query->where("orders.id", 'like', "%$request->search%");
            }
        }
        if ($request->grand_total != 0 && $request->grand_total != null) {
            $query =    $query->where("orders.grand_total", 'like', "%$request->grand_total%");
        }

        if ($request->delivery_status != "") {
            $query =    $query->where("orders.delivery_status", $request->delivery_status);
        }
        if ($request->payment_status != "") {
            $query =    $query->where("orders.payment_status", $request->payment_status);
        }
        if ($request->code != "" || $request->search != "") {
            if ($request->code != "") {
                $query =    $query->where("orders.code", 'like', "%$request->code%");
            } else if ($request->search != "" && preg_match('/\d{8}-\d{8}/', $request->search)) {
                $query =    $query->where("orders.code", 'like', "%$request->search%");
            }
        }


        if ($request->customer != "" || $request->search != "") {
            if ($request->customer != "") {
                $query =    $query->where("users.name", 'like', "%$request->customer%");
            } else if (preg_match('/^[A-Za-z0-9_-]*$/', $request->search) && !preg_match('/\d{8}-\d{8}/', $request->search) && !is_numeric($request->search)) {
                $query =    $query->where("users.name", 'like', "%$request->search%");
            }
        }

        if ($request->startDate != null && $request->endDate != null) {
            $query =    $query->whereBetween('orders.created_at', [$request->startDate, $request->endDate]);
        }


        $counter =   $query->select(DB::raw("COUNT(orders.id) / $request->limit as counter"), DB::raw("COUNT(orders.id) as rowss"))->get();

        $queryCounter = $query;
        $query =  $query->select(
            'orders.delivery_status',
            'orders.payment_status',
            'orders.id',
            'orders.code',
            'orders.created_at',
            DB::raw("CONCAT('$symbol', orders.grand_total) AS grand_total"),
            'users.name as customer'
        );
        $orders =  $query
            ->offset($request->skip)
            ->limit($request->limit)
            ->orderByDesc("orders.id")
            ->get();



        // $counter =  $counter_query->get();
        //  }

        return response()->json([
            "orders" => $orders,
            "counter" => round(empty((int)$counter[0]->counter) ? 0 : (int)$counter[0]->counter),
            "rows" => round(empty((int)$counter[0]->rowss) ? 0 : (int)$counter[0]->rowss)

        ]);
    }
}
