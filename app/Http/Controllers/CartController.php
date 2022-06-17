<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\SubSubCategory;
use App\Category;
use Session;
use App\Color;
use App\Models\Cart;
use App\Models\CartFile;
use App\Models\Notification;
use App\MyClasses\Notify;
use App\MyClasses\OrdersNotes;
use App\User;
use Cookie;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToArray;
use Pusher\Pusher;

class CartController extends Controller
{
    public function index(Request $request)
    {

        //  $categories = Category::all();
        //return dd($categories);

        $countries = DB::table('countries')
            // ->where("status", 1)
            ->select("tel", "code")
            ->get();

        $carts = auth()->check() ? auth()->user()->carts : null;
        return view('frontend.view_cart', compact('carts', 'countries'));
    }

    public function showCartModal(Request $request)
    {
        $product = Product::find($request->id);
        return view('frontend.partials.addToCart', compact('product'));
    }

    public function updateNavCart(Request $request)
    {
        return view('frontend.partials.cart');
    }

    public function addNotesPhotos(Request $request)
    {
        OrdersNotes::put_session_photos($request);
    }
    public function addOrderTypePharmacy(Request $request)
    {
    }

    public function addToCart(Request $request)
    {


        OrdersNotes::put_session_OrderTypePharmacy($request);
        OrdersNotes::put_session_photos($request);


        $files = explode(",", $request->photos);

        $product = Product::find($request->id);
        $check_order =   OrdersNotes::check_order_note_photos($request->id);
        if ($check_order) {
            return array('status' => 3, 'msg' => translate("please put files"));
        }

        $data = array();
        $data['id'] = $product->id;
        $data['owner_id'] = $product->user_id;
        $str = '';
        $tax = 0;


        // if ($product->digital != 1 && $request->quantity < $product->min_qty) {
        //     return array('status' => 0, 'view' => view('frontend.partials.minQtyNotSatisfied', [
        //         'min_qty' => $product->min_qty
        //     ])->render());
        // }


        //check the color enabled or disabled for the product
        if ($request->has('color')) {
            $str = $request['color'];
        }


        //  if ($product->digital != 1) {
        //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
        foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
            if ($str != null) {
                $str .= '-' . str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
            } else {
                $str .= str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
            }
        }
        //   }

        if ($request->has("variant")) {
            $str = $request->variant;
        } else {
            $str = $str;
        }
        $data['variant'] = $str;
        // return dd($request->all());


        if ($str != null && $product->variant_product) {

            //  return $product->stocks;
            $product_stock = $product->stocks->where('variant', $str)->first();
            //$price = $product_stock->price;
            $price = product_discount($product, $product_stock->price)["price"];

            $quantity = $product_stock->qty;

            if ($quantity < $request['quantity']) {
                return array('status' => 0, 'view' => view('frontend.partials.outOfStockCart')->render());
            }
        } else {
            //  $price = $product->unit_price;
            $price = product_discount($product)["price"];
        }

        //discount calculation based on flash deal and regular discount
        //calculation of taxes
        ///     $price = product_discount($product)["price"];

        foreach ($product->taxes as $product_tax) {
            if ($product_tax->tax_type == 'percent') {
                $tax += ($price * $product_tax->tax) / 100;
            } elseif ($product_tax->tax_type == 'amount') {
                $tax += $product_tax->tax;
            }
        }

        $data['quantity'] = $request['quantity'];
        $data['price'] = $price;
        $data['tax'] = $tax;
        $data['shipping'] = 0;
        $data['product_referral_code'] = null;
        $data['cash_on_delivery'] = $product->cash_on_delivery;
        $data['digital'] = $product->digital;

        if ($request['quantity'] == null) {
            $data['quantity'] = 1;
        }

        if (Cookie::has('referred_product_id') && Cookie::get('referred_product_id') == $product->id) {
            $data['product_referral_code'] = Cookie::get('product_referral_code');
        }

        // $Pusher = new Pusher(
        //     get_setting('PUSHER_APP_KEY'),
        //     get_setting('PUSHER_APP_SECRET'),
        //     get_setting('PUSHER_APP_ID'),
        //     [
        //         'cluster' => get_setting('PUSHER_APP_CLUSTER'),

        //     ]

        // );

        //  return $data;

        if (auth()->check()) {

            $cart = Cart::where("product_id", $data["id"])->where("user_id", auth()->user()->id)->where("variation", $data["variant"])->first();

            if (!empty($cart)) {
                $cart->quantity += $request["quantity"];
                $cart->save();
            } else {

                $Cart = new Cart();
                $Cart->owner_id = $data["owner_id"];
                $Cart->price = $data["price"];
                $Cart->quantity = $data["quantity"];
                $Cart->tax = $data["tax"];
                $Cart->shipping_cost = $data["shipping"];
                $Cart->product_id = $data["id"];
                $Cart->user_id = auth()->check() ? auth()->user()->id : null;
                $Cart->variation = $data["variant"];
                $Cart->save();
            }




            $datas = [
                "user_name" => auth()->check() ? auth()->user()->name : "User Guesst",
                "price" => ($data["price"] + $data["tax"] + $data["shipping"])  * (empty($cart) ? $Cart->quantity : $cart->quantity),
                "product_name" => Product::find($data["id"])->name,
                "src" => auth()->user()->avatar != null ? auth()->user()->avatar : "public/assets/img/avatar-place.png"

            ];
            (new Notify)->add_cart_notify($datas);

            // $Pusher->trigger('CartChannel.' . $user->id, 'CartEvent', ['data' => $datas]);


        }

        if (session()->has('cart') && !auth()->check()) {
            $foundInCart = false;
            $cart = collect();

            foreach (session()->get('cart') as $key => $cartItem) {
                if ($cartItem['id'] == $request->id) {
                    if ($str != null && $cartItem['variant'] == $str) {
                        $product_stock = $product->stocks->where('variant', $str)->first();
                        $quantity = $product_stock->qty;

                        if ($quantity < $cartItem['quantity'] + $request['quantity']) {
                            return array('status' => 0, 'view' => view('frontend.partials.outOfStockCart')->render());
                        } else {
                            $foundInCart = true;
                            $cartItem['quantity'] += $request['quantity'];
                        }
                    } elseif ($product->current_stock < $cartItem['quantity'] + $request['quantity']) {
                        return array('status' => 0, 'view' => view('frontend.partials.outOfStockCart')->render());
                    } else {
                        $foundInCart = true;
                        $cartItem['quantity'] += $request['quantity'];
                    }
                }

                $cart->push($cartItem);
            }

            if (!$foundInCart) {
                $cart->push($data);
            }
            session()->put('cart', $cart);
        } else {
            $cart = collect([$data]);
            session()->put('cart', $cart);
        }

        return array('status' => 1, 'view' => view('frontend.partials.addedToCart', compact('product', 'data'))->render());
    }

    //add carts
    public function add_carts(Request $req)
    {
        // return $req->all();
        $files = explode(",", $req->photos);

        $carts  = [];

        //return dd($req->products);
        foreach ($req->products as $request) {

            $request = new Request($request);

            $product = Product::find($request->id);

            $data = array();
            $data['id'] = $product->id;
            $data['owner_id'] = $product->user_id;
            $str = '';
            $tax = 0;


            if ($product->digital != 1 && $request->quantity < $product->min_qty) {
                return array('status' => 0, 'view' => view('frontend.partials.minQtyNotSatisfied', [
                    'min_qty' => $product->min_qty
                ])->render());
            }


            //check the color enabled or disabled for the product
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

            if ($product->digital != 1) {
                //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
                foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
                    if ($str != null) {
                        $str .= '-' . str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                    } else {
                        $str .= str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                    }
                }
            }

            $data['variant'] = $str;




            if ($str != null && $product->variant_product) {

                //  return $product->stocks;
                $product_stock = $product->stocks->where('variant', $str)->first();
                // $price = $product_stock->price;
                $price = product_discount($product, $product_stock->price)["price"];

                $quantity = $product_stock->qty;

                if ($quantity < $request['quantity']) {
                    return array('status' => 0, 'view' => view('frontend.partials.outOfStockCart')->render());
                }
            } else {
                $price = product_discount($product)["price"];
            }

            //discount calculation based on flash deal and regular discount
            //calculation of taxes
            // if (!empty($product_stock)) {
            //     $price = product_discount($product, $product_stock->price)["price"];
            // } else {
            //     $price = product_discount($product)["price"];
            // }


            foreach ($product->taxes as $product_tax) {
                if ($product_tax->tax_type == 'percent') {
                    $tax += ($price * $product_tax->tax) / 100;
                } elseif ($product_tax->tax_type == 'amount') {
                    $tax += $product_tax->tax;
                }
            }

            $data['quantity'] = $request['quantity'];
            $data['price'] = $price;
            $data['tax'] = $tax;
            $data['shipping'] = 0;
            $data['product_referral_code'] = null;
            $data['cash_on_delivery'] = $product->cash_on_delivery;
            $data['digital'] = $product->digital;

            if ($request['quantity'] == null) {
                $data['quantity'] = 1;
            }

            if (Cookie::has('referred_product_id') && Cookie::get('referred_product_id') == $product->id) {
                $data['product_referral_code'] = Cookie::get('product_referral_code');
            }
            //  $Pusher = new Pusher(
            //             get_setting('PUSHER_APP_KEY'),
            //             get_setting('PUSHER_APP_SECRET'),
            //             get_setting('PUSHER_APP_ID'),
            //             [
            //                 'cluster' => get_setting('PUSHER_APP_CLUSTER'),

            //             ]

            //         );

            //  return $data;
            if (auth()->check()) {

                $Cart = Cart::where("product_id", $data["id"])->where("user_id", auth()->user()->id)->where("variation", $data["variant"])->first();

                if (!empty($Cart)) {
                    $Cart->quantity += $data["quantity"];
                    $Cart->save();
                } else {
                    $Cart = new Cart();
                    $Cart->owner_id = $data["owner_id"];
                    $Cart->price = $data["price"];
                    $Cart->quantity = $data["quantity"];
                    $Cart->tax = $data["tax"];
                    $Cart->shipping_cost = $data["shipping"];
                    $Cart->product_id = $data["id"];
                    $Cart->user_id = $req->customer_id;
                    $Cart->variation = $data["variant"];
                    $Cart->order_admin = auth()->user()->id;


                    $Cart->save();
                }






                $datas = [
                    "user_name" => auth()->check() ? auth()->user()->name : "User Guesst",
                    "price" => ($data["price"] + $data["tax"] + $data["shipping"])  * (empty($Cart) ? $Cart->quantity : $Cart->quantity),
                    "product_name" => Product::find($data["id"])->name,
                    "src" => auth()->user()->avatar != null ? auth()->user()->avatar :  "public/assets/img/avatar-place.png"

                ];

                (new Notify)->add_cart_notify($datas);
            }

            $carts[] = $Cart;
        }


        if (count($carts) != 0) {
            $sellerIds = [];
            foreach ($carts as $item) {

                $sellerIds[] = $item["owner_id"];
            }
        }

        $sellersCarts = [];
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
        $cartsData = [];
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

        $newOrders = new NewerOrderController();
        $cartsDataOrders =   $newOrders->sellersData();
        return response()->json([
            "carts" => $cartsDataOrders
        ]);
    }

    //removes from Cart



    public function removeFromCart(Request $request)
    {

        // return $request->all();
        // $cart = Cart::find($request->key);

        // // return $request->key;
        // if (!empty($cart)) {
        //     $cart->delete();
        // }
        // // return $request->all();
        // if ($request->session()->has('cart')) {
        //     $cart = $request->session()->get('cart', collect([]));
        //     $cart->forget($request->key);
        //     $request->session()->put('cart', $cart);
        // }

        if (auth()->check()) {
            $cart = Cart::find($request->id);
            $cart->delete();
            // foreach ($carts as $cart) {
            //     $cart->delete();
            // }
        } else {
            $cart = $request->session()->get('cart', collect([]));
            $cart->forget($request->key);
            $request->session()->put('cart', $cart);
        }

        return view('frontend.partials.cart_details');
    }



    public function removeAllCarts(Request $request)
    {

        if (auth()->check()) {
            $carts = Cart::where("user_id", auth()->user()->id)->get();
            foreach ($carts as $cart) {
                $cart->delete();
            }
        } else {
            $request->session()->forget('cart');
            Session::forget('note_order');
            Session::forget('oreder_type_pharmacy');
            Session::save();
        }

        return view('frontend.partials.cart_details');
    }
    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $prduct_id = "id";
        $variant = "variant";

        if (auth()->check()) {

            $cart = collect([Cart::find($request->cart_id)]);
            $prduct_id = "product_id";
            $variant = "variation";
        } else {
            $cart = $request->session()->get('cart', collect([]));
        }

        //  $cart = $request->session()->get('cart', collect([]));

        if (auth()->check()) {

            $cart = $cart->map(function ($object, $key) use ($request, $prduct_id, $variant) {


                // if ($key == $request->key) {
                $product = \App\Product::find($object[$prduct_id]);


                if ($object[$variant] != null && $product->variant_product) {

                    $product_stock = $product->stocks->where('variant', $object[$variant])->first();
                    $quantity = $product_stock->qty;
                    if ($quantity >= $request->quantity) {
                        if ($request->quantity >= $product->min_qty) {
                            $object['quantity'] = $request->quantity;
                        }
                    }
                } elseif ($product->current_stock >= $request->quantity) {

                    if ($request->quantity >= $product->min_qty) {
                        $object['quantity'] = $request->quantity;
                    }
                }
                //}
                return $object;
            });
            $cart[0]->save();
        } else {

            $cart = $cart->map(function ($object, $key) use ($request, $prduct_id, $variant) {


                if ($key == $request->key) {
                    $product = \App\Product::find($object[$prduct_id]);

                    if ($object[$variant] != null && $product->variant_product) {
                        $product_stock = $product->stocks->where('variant', $object[$variant])->first();
                        $quantity = $product_stock->qty;
                        if ($quantity >= $request->quantity) {
                            if ($request->quantity >= $product->min_qty) {
                                $object['quantity'] = $request->quantity;
                            }
                        }
                    } elseif ($product->current_stock >= $request->quantity) {
                        if ($request->quantity >= $product->min_qty) {
                            $object['quantity'] = $request->quantity;
                        }
                    }
                }
                return $object;
            });
            $request->session()->put('cart', $cart);
        }


        return view('frontend.partials.cart_details');
    }

    public function setCookie(Request $req)
    {
        if (isset($_COOKIE["otp"])) {
            return response()->json([
                "data" => 1
            ]);
        } else {
            setCookiess("otp", "1", 750);
            return response()->json([
                "data" => 0
            ]);
        }
    }

    public function check_order_note_photos(Request $req)
    {
        $order_note = OrdersNotes::check_order_note_photos($req->product_id);
        return response()->json([
            "data" => $order_note
        ]);
    }
}
