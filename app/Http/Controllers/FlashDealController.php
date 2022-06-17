<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FlashDeal;
use App\FlashDealTranslation;
use App\FlashDealProduct;
use Illuminate\Support\Str;
use App\Product;
use App\MyClasses\Cat;

class FlashDealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $flash_deals = FlashDeal::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $flash_deals = $flash_deals->where('title', 'like', '%' . $sort_search . '%');
        }
        $flash_deals = $flash_deals->paginate(15);
        return view('backend.marketing.flash_deals.index', compact('flash_deals', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.marketing.flash_deals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $products = json_decode($request->products);



        $flash_deal = new FlashDeal;
        $flash_deal->title = $request->title;
        $flash_deal->text_color = $request->text_color;

        $date_var               = explode(" to ", $request->date_range);
        $flash_deal->start_date = strtotime($date_var[0]);
        $flash_deal->end_date   = strtotime($date_var[1]);

        $flash_deal->background_color = $request->background_color;
        $flash_deal->slug = strtolower(str_replace(' ', '-', $request->title) . '-' . Str::random(5));
        $flash_deal->banner = $request->banner;
        if ($flash_deal->save()) {
            foreach ($products as $key => $product) {
                $flash_deal_product = new FlashDealProduct;
                $flash_deal_product->flash_deal_id = $flash_deal->id;
                $flash_deal_product->product_id = $product->id;
                $flash_deal_product->discount = $product->discount;
                $flash_deal_product->discount_type = $product->type;
                $flash_deal_product->save();
            }

            $flash_deal_translation = FlashDealTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'flash_deal_id' => $flash_deal->id]);
            $flash_deal_translation->title = $request->title;
            $flash_deal_translation->save();

            flash(translate('Flash Deal has been inserted successfully'))->success();
            return redirect()->route('flash_deals.index');
        } else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
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
    public function edit(Request $request, $id)
    {
        $lang           = $request->lang;
        $flash_deal = FlashDeal::findOrFail($id);
        $products = [];
        foreach ($flash_deal->flash_deal_products as $item) {
            $products[] = [
                "id" => $item->product_id,
                "discount" => $item->discount,
                "type" => $item->discount_type,
            ];
        }

        $prducts_encode = json_encode($products);
        return view('backend.marketing.flash_deals.edit', compact('flash_deal', 'lang', 'prducts_encode'));
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

        //return dd($request->all());
        $products = json_decode($request->products);
        $flash_deal = FlashDeal::findOrFail($id);

        $flash_deal->text_color = $request->text_color;

        $date_var               = explode(" to ", $request->date_range);
        $flash_deal->start_date = strtotime($date_var[0]);
        $flash_deal->end_date   = strtotime($date_var[1]);

        $flash_deal->background_color = $request->background_color;

        if ($request->lang == env("DEFAULT_LANGUAGE")) {
            $flash_deal->title = $request->title;
            if (($flash_deal->slug == null) || ($flash_deal->title != $request->title)) {
                $flash_deal->slug = strtolower(str_replace(' ', '-', $request->title) . '-' . Str::random(5));
            }
        }

        $flash_deal->banner = $request->banner;
        foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product) {
            $flash_deal_product->delete();
        }
        if ($flash_deal->save()) {
            foreach ($products as $key => $product) {
                $flash_deal_product = new FlashDealProduct;
                $flash_deal_product->flash_deal_id = $flash_deal->id;
                $flash_deal_product->product_id = $product->id;
                $flash_deal_product->discount = $product->discount;
                $flash_deal_product->discount_type = $product->type;
                $flash_deal_product->save();
            }

            $sub_category_translation = FlashDealTranslation::firstOrNew(['lang' => $request->lang, 'flash_deal_id' => $flash_deal->id]);
            $sub_category_translation->title = $request->title;
            $sub_category_translation->save();

            flash(translate('Flash Deal has been updated successfully'))->success();
            return back();
        } else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flash_deal = FlashDeal::findOrFail($id);
        foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product) {
            $flash_deal_product->delete();
        }

        foreach ($flash_deal->flash_deal_translations as $key => $flash_deal_translation) {
            $flash_deal_translation->delete();
        }

        FlashDeal::destroy($id);
        flash(translate('FlashDeal has been deleted successfully'))->success();
        return redirect()->route('flash_deals.index');
    }

    public function update_status(Request $request)
    {
        $flash_deal = FlashDeal::findOrFail($request->id);
        $flash_deal->status = $request->status;
        if ($flash_deal->save()) {
            flash(translate('Flash deal status updated successfully'))->success();
            return 1;
        }
        return 0;
    }

    public function update_featured(Request $request)
    {
        foreach (FlashDeal::all() as $key => $flash_deal) {
            $flash_deal->featured = 0;
            $flash_deal->save();
        }
        $flash_deal = FlashDeal::findOrFail($request->id);
        $flash_deal->featured = $request->featured;
        if ($flash_deal->save()) {
            flash(translate('Flash deal status updated successfully'))->success();
            return 1;
        }
        return 0;
    }

    public function product_discount(Request $request)
    {
        $product_ids = $request->product_ids;
        return view('backend.marketing.flash_deals.flash_deal_discount', compact('product_ids'));
    }

    public function product_discount_edit(Request $request)
    {
        $product_ids = $request->product_ids;
        $flash_deal_id = $request->flash_deal_id;
        return view('backend.marketing.flash_deals.flash_deal_discount_edit', compact('product_ids', 'flash_deal_id'));
    }
    
        public function search_product_discount(Request $request)
    {


        $product = Product::query();

        if ($request->name != "") {
            $product->where("name", $request->name);
        }
        if ($request->discount != "") {
            $product->where("discount", $request->discount);
        }
        if ($request->unit_price != "") {
            $product->where("unit_price", $request->unit_price);
        }
        if ($request->brand_id != "") {
            $product->where("brand_id", $request->brand_id);
        }
        if ($request->category_id != "") {
            $product->whereIn("products.category_id", Cat::children_cat($request->category_id));
        }
        if ($request->current_stock != "") {
            $product->where("current_stock", $request->current_stock);
        }
        if ($request->purchase_price != "") {
            $product->where("purchase_price", $request->purchase_price);
        }
        if ($request->shipping_cost != "") {
            $product->where("shipping_cost", $request->shipping_cost);
        }


        $products = $product->offset($request->offset)->limit($request->limit)->get();

        $view = view("backend.marketing.flash_deals.product_list", ["products" => $products])->render();
        return  response()->json([
            "view" => $view,
            "products" => $request->all()
        ]);
    }

    public function search_product_discount_list(Request $request)
    {


        $product = Product::query();

        if ($request->name != "") {
            $product->where("name", $request->name);
        }
        if ($request->discount != "") {
            $product->where("discount", $request->discount);
        }
        if ($request->unit_price != "") {
            $product->where("unit_price", $request->unit_price);
        }
        if ($request->brand_id != "") {
            $product->where("brand_id", $request->brand_id);
        }
        if ($request->category_id != "") {
            $product->whereIn("products.category_id", Cat::children_cat($request->category_id));
        }
        if ($request->current_stock != "") {
            $product->where("current_stock", $request->current_stock);
        }
        if ($request->purchase_price != "") {
            $product->where("purchase_price", $request->purchase_price);
        }
        if ($request->shipping_cost != "") {
            $product->where("shipping_cost", $request->shipping_cost);
        }


        $products = $product->offset($request->offset)->limit($request->limit)->get();

        $view = view("backend.marketing.flash_deals.list", ["products" => $products])->render();
        return  response()->json([
            "view" => $view,
            "products" => $request->all()
        ]);
    }
}
