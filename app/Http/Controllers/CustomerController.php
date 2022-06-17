<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\Order;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type = null)
    {

        // if ($type != null) {
        //     $sort_search = null;
        //     $customers = Customer::orderBy('created_at', 'desc')->get();
        //     $customers_data = [];

        //     foreach ($customers as $item) {

        //         if ($item->user != null) {


        //             if (is_numeric($request->search)) {


        //                 if (preg_match("/{$request->search}/i", $item->user->phone)) {

        //                     $customers_data[] =  $item;
        //                 }
        //             } else {

        //                 if (preg_match("/{$request->search}/i", $item->user->name)) {

        //                     $customers_data[] =  $item;
        //                 }
        //             }
        //         }
        //     }


        //     $customers =  (new Collection($customers_data))->paginate(15);
        //     return view('backend.customer.customers.index', compact('customers', 'sort_search'));
        // }
        $sort_search = null;
        $customers = Customer::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $user_ids = User::where('user_type', 'customer')->where(function ($user) use ($sort_search) {
                $user->where('name', 'like', '%' . $sort_search . '%')->orWhere('email', 'like', '%' . $sort_search . '%');
            })->pluck('id')->toArray();
            $customers = $customers->where(function ($customer) use ($user_ids) {
                $customer->whereIn('user_id', $user_ids);
            });
        }
        $customers = $customers->paginate(15);

        return view('backend.customer.customers.index', compact('customers', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|unique:users|email',
            'phone'         => 'required|unique:users',
        ]);

        $response['status'] = 'Error';

        $user = User::create($request->all());

        $customer = new Customer;

        $customer->user_id = $user->id;
        $customer->save();

        if (isset($user->id)) {
            $html = '';
            $html .= '<option value="">
                        ' . translate("Walk In Customer") . '
                    </option>';
            foreach (Customer::all() as $key => $customer) {
                if ($customer->user) {
                    $html .= '<option value="' . $customer->user->id . '" data-contact="' . $customer->user->email . '">
                                ' . $customer->user->name . '
                            </option>';
                }
            }

            $response['status'] = 'Success';
            $response['html'] = $html;
        }

        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::where('user_id', Customer::findOrFail($id)->user->id)->delete();
        User::destroy(Customer::findOrFail($id)->user->id);
        if (Customer::destroy($id)) {
            flash(translate('Customer has been deleted successfully'))->success();
            return redirect()->route('customers.index');
        }

        flash(translate('Something went wrong'))->error();
        return back();
    }
    public function destroyjs($id)
    {

        $customer = Customer::where("user_id", $id)->first();
        if (!empty($customer)) {
            Order::where('user_id', Customer::findOrFail($customer->id)->user->id)->delete();
            User::destroy(Customer::findOrFail($customer->id)->user->id);
            if (Customer::destroy($customer->id)) {


                return response()->json([
                    "msg" => translate(("delete done"))
                ]);

                // flash(translate('Customer has been deleted successfully'))->success();
                // return redirect()->route('customers.index');
            }
        }
        return response()->json([
            "msg" => translate(("customer is empty"))
        ]);
    }

    public function login($id)
    {


        $user = User::find(customDecrypt($id));


        auth()->login($user, true);

        return redirect()->route('dashboard');
    }


    public function login_complete_order($id)
    {

        $user = User::find(customDecrypt($id));

        //   $customer = Customer::where("user_id",customDecrypt($id));

        // $user  = $customer->user;

        auth()->login($user, true);

        return redirect()->route('checkout.shipping_info');
    }



    public function ban($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->user->banned == 1) {
            $customer->user->banned = 0;
            flash(translate('Customer UnBanned Successfully'))->success();
        } else {
            $customer->user->banned = 1;
            flash(translate('Customer Banned Successfully'))->success();
        }

        $customer->user->save();

        return back();
    }



    public function banjs($id)
    {


        $customer = Customer::where("user_id", $id)->first();

        if ($customer->user->banned == 1) {
            $customer->user->banned = 0;
            //flash(translate('Customer UnBanned Successfully'))->success();
        } else {
            $customer->user->banned = 1;
            // flash(translate('Customer Banned Successfully'))->success();
        }

        $customer->user->save();

        return response()->json([
            "msg" => "done"
        ]);
    }


    public function getCustomers(Request $request)
    {
        $customers = User::where("user_type", "customer")
            ->skip($request->pagination)
            ->take(20);

        if ($request->name != "") {
            $customers->Where('name', 'like', '%' . $request->name . '%');
        } else if ($request->phone != "") {
            $customers->Where('phone', 'like', '%' . $request->phone . '%');
        } else if ($request->email != "") {
            $customers->Where('email', 'like', '%' . $request->email . '%');
        } else if ($request->country_id != "") {
            $customers->Where('country_id', $request->country_id);
        } else if ($request->city_id != "") {
            $customers->Where('city_id', $request->city_id)->get();
        }

        $customers = $customers->get();
        return response()->json([
            "customers" => $customers
        ]);
    }


    public function customersjs(Request $request)
    {

        return view("backend.customer.customers.customerjs", ["search" => $request->search]);
    }



    public function search_customers(Request $request)
    {

        $symbol = currency_symbol();


        $query =  DB::table('users')

            ->select('users.id', 'users.email', 'users.name', 'users.created_at', DB::raw("CONCAT('$symbol', users.balance) AS balance"))
            ->whereBetween('users.created_at', [$request->startDate, $request->endDate])
            ->where("user_type", 'customer');


        if ($request->id != 0 && $request->id != null) {
            $query =    $query->where("users.id", 'like', "%$request->id%");
        }

        if ($request->name != "") {
            $query =    $query->where("users.name", 'like', "%$request->name%");
        }

        if ($request->email != "") {
            $query =    $query->where("users.email", 'like', "%$request->email%");
        }

        if ($request->balance != 0 && $request->balance != null) {
            $query =    $query->where("users.balance", 'like', "%$request->balance%");
        }
        $customers = $query->get();


        return response()->json([
            "customers" => $customers
        ]);
    }

    public function CustomerOrders($id)
    {
        $symbol = currency_symbol();


        $orders = DB::select("SELECT  orders.code,orders.created_at,orders.delivery_status,products.name,uploads.file_name,orders.id
        FROM users
        INNER JOIN orders ON users.id = orders.user_id
         INNER JOIN order_details ON order_details.order_id = orders.id
        INNER JOIN products ON products.id = order_details.product_id
        INNER JOIN uploads ON uploads.id = products.photos

        WHERE users.user_type = 'customer' AND users.id = $id");

        // $orders_count = DB::select("SELECT SUM(orders.grand_total) AS totalPrice
        // FROM users
        // INNER JOIN orders ON users.id = orders.user_id
        // WHERE users.user_type = 'customer' AND users.id = $id

        // ");


        return response()->json([
            "orders" => $orders,
            // "totalPrice" => single_price($orders_count[0]->totalPrice)
        ]);
    }



    public function customers_data(Request $request)
    {
        $symbol = translate(currency_symbol());



        $query  = DB::table('users')
            ->join("customers", function ($join) {
                $join->on("users.id", "=", "customers.user_id");
            })
            ->where("user_type", 'customer');



        if ($request->id != 0 && $request->id != null) {
            $query =    $query->where("users.id", 'like', "%$request->id%");
        }

        if ($request->name != "" || $request->search != "") {
            if ($request->name != "") {
                $query =    $query->where("users.name", 'like', "%$request->name%");
            } else if ($request->search != "" && preg_match('/^[A-Za-z0-9_-]*$/', $request->search) && !is_numeric($request->search)) {
                $query =    $query->where("users.name", 'like', "%$request->search%");
            }
        }

        if ($request->email != "") {
            $query =    $query->where("users.email", 'like', "%$request->email%");
        }

        if ($request->phone != 0 && $request->phone != null || $request->search != "") {

            if ($request->phone != "") {
                $query =    $query->where("users.phone", 'like', "%$request->phone%");
            } else if ($request->search != "" && is_numeric($request->search)) {
                $query =    $query->where("users.phone", 'like', "%$request->search%");
            }
        }


        if ($request->balance != 0 && $request->balance != null) {
            $query =    $query->where("users.balance", 'like', "%$request->balance%");
        }



        $counter =   $query->select(DB::raw("COUNT(users.id) / $request->limit as counter"), DB::raw("COUNT(users.id) as rowss"))->get();

        $queryCounter = $query;
        $query = $query->select('users.id', 'users.email', 'users.name', 'users.phone', 'users.banned', 'users.created_at', DB::raw("CONCAT(users.balance,' $symbol ') AS balance"));
        $customers =  $query
            ->groupBy("customers.id")
            ->offset($request->skip)
            ->limit($request->limit)
            ->get();



        // $counter =  $counter_query->get();
        //  }

        return response()->json([
            "customers" => $customers,
            "counter" => round(empty((int)$counter[0]->counter) ? 0 : (int)$counter[0]->counter),
            "rows" => round(empty((int)$counter[0]->rowss) ? 0 : (int)$counter[0]->rowss)

        ]);
    }



    public function customers_count(Request $request)
    {
        $customers = DB::select("SELECT COUNT(*) AS all_customers from users where user_type = 'customer' ");

        return response()->json([
            "customers_count" => $customers[0]->all_customers
        ]);
    }
   public function customer_profile($customer_id)
    {
        $customer = User::find($customer_id);

        return view("backend.customer.customers.customer_profile", ["customer" => $customer]);
    }



    public function customerData($id)
    {
        $user = User::find(customDecrypt($id));

        return response()->json([
            "user" => $user
        ]);
    }

    public function msg_add_cart(Request $request)
    {
        $user = User::find($request->id);
        $user->show_msg_add_cart = $request->msg ? 1 : 0;
        $user->save();
    }
}
