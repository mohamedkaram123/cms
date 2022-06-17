<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use App\User;
use App\Shop;
use App\Product;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Facades\Hash;
use App\Notifications\EmailVerificationNotification;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type = null)
    {


        if ($type != null) {
            $sort_search = null;
            $approved = null;

            $sellers = Seller::orderBy('created_at', 'desc')->get();
            $sellers_data = [];

            foreach ($sellers as $item) {

                if ($item->user != null) {


                    if (is_numeric($request->search)) {


                        if (preg_match("/{$request->search}/i", $item->user->phone)) {

                            $sellers_data[] =  $item;
                        }
                    } else {

                        if (preg_match("/{$request->search}/i", $item->user->name)) {

                            $sellers_data[] =  $item;
                        }
                    }
                }
            }


            $sellers =  (new Collection($sellers_data))->paginate(15);
            return view('backend.sellers.index', compact('sellers', 'sort_search', 'approved'));
        }

        $sort_search = null;
        $approved = null;
        $sellers = Seller::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $user_ids = User::where('user_type', 'seller')->where(function ($user) use ($sort_search) {
                $user->where('name', 'like', '%' . $sort_search . '%')->orWhere('email', 'like', '%' . $sort_search . '%');
            })->pluck('id')->toArray();
            $sellers = $sellers->where(function ($seller) use ($user_ids) {
                $seller->whereIn('user_id', $user_ids);
            });
        }
        if ($request->approved_status != null) {
            $approved = $request->approved_status;
            $sellers = $sellers->where('verification_status', $approved);
        }
        $sellers = $sellers->paginate(15);
        return view('backend.sellers.index', compact('sellers', 'sort_search', 'approved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('email', $request->email)->first() != null) {
            flash(translate('Email already exists!'))->error();
            return back();
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = "seller";
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            if (get_setting('email_verification') != 1) {
                $user->email_verified_at = date('Y-m-d H:m:s');
            } else {
                $user->notify(new EmailVerificationNotification());
            }
            $user->save();

            $seller = new Seller;
            $seller->user_id = $user->id;
            if ($seller->save()) {
                $shop = new Shop;
                $shop->user_id = $user->id;
                $shop->slug = 'demo-shop-' . $user->id;
                $shop->save();
                flash(translate('Seller has been inserted successfully'))->success();
                return redirect()->route('sellers.index');
            }
        }
        flash(translate('Something went wrong'))->error();
        return back();
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
        $seller = Seller::findOrFail(decrypt($id));
        return view('backend.sellers.edit', compact('seller'));
    }

    public function editjs($id)
    {
        $seller = Seller::findOrFail(customDecrypt($id));
        return view('backend.sellers.edit', compact('seller'));
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
        $seller = Seller::findOrFail($id);
        $user = $seller->user;
        $user->name = $request->name;
        $user->email = $request->email;
        if (strlen($request->password) > 0) {
            $user->password = Hash::make($request->password);
        }
        if ($user->save()) {
            if ($seller->save()) {
                flash(translate('Seller has been updated successfully'))->success();
                return redirect()->route('sellers.index');
            }
        }

        flash(translate('Something went wrong'))->error();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        Shop::where('user_id', $seller->user_id)->delete();
        Product::where('user_id', $seller->user_id)->delete();
        Order::where('user_id', $seller->user_id)->delete();
        OrderDetail::where('seller_id', $seller->user_id)->delete();
        User::destroy($seller->user->id);
        if (Seller::destroy($id)) {
            flash(translate('Seller has been deleted successfully'))->success();
            return redirect()->route('sellers.index');
        } else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function show_verification_request($id)
    {
        $seller = Seller::findOrFail($id);
        return view('backend.sellers.verification', compact('seller'));
    }

    public function approve_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->verification_status = 1;
        if ($seller->save()) {
            flash(translate('Seller has been approved successfully'))->success();
            return redirect()->route('sellers.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }

    public function reject_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->verification_status = 0;
        $seller->verification_info = null;
        if ($seller->save()) {
            flash(translate('Seller verification request has been rejected successfully'))->success();
            return redirect()->route('sellers.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }


    public function payment_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        return view('backend.sellers.payment_modal', compact('seller'));
    }

    public function profile_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        return view('backend.sellers.profile_modal', compact('seller'));
    }

    public function updateApproved(Request $request)
    {
        $seller = Seller::findOrFail($request->id);

        //if ($request->status == 0) {
        foreach ($seller->products as $item) {
            $item->published = $request->status;
            $item->save();
        }
        //}
        $seller->verification_status = $request->status;
        if ($seller->save()) {
            return 1;
        }
        return 0;
    }

    public function login($id)
    {
        $seller = Seller::findOrFail(decrypt($id));

        $user  = $seller->user;

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    public function loginjs($id)
    {
        $seller = Seller::findOrFail(customDecrypt($id));

        $user  = $seller->user;

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }


    public function ban($id)
    {
        $seller = Seller::findOrFail($id);

        if ($seller->user->banned == 1) {
            $seller->user->banned = 0;
            flash(translate('Seller has been unbanned successfully'))->success();
        } else {
            $seller->user->banned = 1;
            flash(translate('Seller has been banned successfully'))->success();
        }

        $seller->user->save();
        return back();
    }


    public function sellersjs(Request $request)
    {

        return view("backend.sellers.sellersjs", ["search" => $request->search]);
    }







    public function search_sellers(Request $request)
    {

        $symbol = currency_symbol();


        $query =  DB::table('users')

            ->select('users.id', 'users.email', 'users.name', 'users.created_at', DB::raw("CONCAT('$symbol', users.balance) AS balance"))
            ->whereBetween('users.created_at', [$request->startDate, $request->endDate])
            ->where("user_type", 'seller');


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
        $sellers = $query->get();


        return response()->json([
            "sellers" => $sellers
        ]);
    }



    public function sellers_data(Request $request)
    {
        $symbol = currency_symbol();



        $query  = DB::table('users')
            ->where("user_type", 'seller')
            ->join('sellers', function ($join) {
                $join->on('users.id', '=', 'sellers.user_id');
            });


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
        $query = $query->select('users.id', 'sellers.id as seller_id', 'users.email', 'users.name', 'users.created_at', DB::raw("CONCAT('$symbol', users.balance) AS balance"));
        $sellers =  $query
            ->offset($request->skip)
            ->limit($request->limit)
            ->get();



        // $counter =  $counter_query->get();
        //  }

        return response()->json([
            "sellers" => $sellers,
            "counter" => round(empty((int)$counter[0]->counter) ? 0 : (int)$counter[0]->counter),
            "rows" => round(empty((int)$counter[0]->rowss) ? 0 : (int)$counter[0]->rowss)

        ]);
    }


    public function seller_profile(Request $request)
    {
        return view("backend.sellers.sellersjs");
    }
}
