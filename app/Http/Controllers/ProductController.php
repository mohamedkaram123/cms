<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use App\Product;
use App\ProductTranslation;
use App\ProductStock;
use App\Category;
use App\FlashDealProduct;
use App\ProductTax;
use App\Language;
use App\Models\Color;
use App\Models\RefurbishedDegree;
use App\MyClasses\Attributes;
use App\Seller;
use Auth;
use App\SubSubCategory;
use App\Upload;
use Session;
use Carbon\Carbon;
use ImageOptimizer;

use App\MyClasses\Combinations;
use App\MyClasses\CoreComponentRepository;
use Illuminate\Support\Str;
use Artisan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\MyClasses\Cat;
use App\MyClasses\RefurbishedProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_products(Request $request)
    {
        //CoreComponentRepository::instantiateShopRepository();

        $type = 'In House';
        $col_name = null;
        $query = null;
        $sort_search = null;

        $products = Product::where('added_by', 'admin');

        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }
        if ($request->search != null) {
            $products = $products
                ->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }

        $products = $products->where('digital', 0)->orderBy('created_at', 'desc')->paginate(15);

        return view('backend.product.products.index', compact('products', 'type', 'col_name', 'query', 'sort_search'));
    }

    public function products_data(Request $request)
    {
        $symbol = translate(currency_symbol());

        $query  = DB::table('products')
            ->leftJoin("uploads", function ($join) {
                $join->on("uploads.id", "=", "products.thumbnail_img");
            })
            ->join("users", function ($join) {
                $join->on("users.id", "=", "products.user_id");
            })

            // ->join("product_stocks", function ($join) {
            //     $join->on("products.id", "=", "product_stocks.product_id");
            // })
            ->where("products.archive", 0)
            ->where("products.digital", 0)

            ->whereDate("products.created_at", ">=", $request->startDate)
            ->whereDate("products.created_at", "<=", $request->endDate);




        // if ($request->has("search") && $request->search != "") {

        //     $str = !$request->has("name") ? $request->search : $request->name;
        //     $query =    $query->where("products.name", 'like', "%$str%");
        // }
        if ($request->name != "" || $request->search != "") {
            if ($request->name != "") {

                $query =    $query->where("products.name", 'like', "%$request->name%");
            } else if ($request->search != ""  && !is_numeric($request->search)) {

                $query =    $query->where("products.name", 'like', "%$request->search%");
            }
        }

        if ($request->category_id != "") {

            $query =    $query->whereIn("products.category_id", Cat::children_cat($request->category_id));
        }
        if ($request->brand_id != "") {
            $query =    $query->where("products.brand_id", $request->brand_id);
        }
        // if ($request->user_name != "") {
        //     $query =    $query->where("users.name", 'like', "%$request->user_name%");
        // }


        $counter =   $query->select(
            DB::raw("COUNT(products.id) / $request->limit as counter"),
            DB::raw("COUNT(products.id) as rowss")
        )->get();

        $query = $query->select(
            'users.name as user_name',
            DB::raw("CONCAT(products.unit_price,' $symbol ') AS price"),
            'products.published',
            'products.featured',
            'products.name',
            'products.created_at',
            'products.refurbished',
            'products.force_file',

            'products.id',
            'products.current_stock',
            'products.exclusive_to_website',
            'products.slug',
            'uploads.file_name as photo',
            'products.category_id',
        );
        $products =  $query
            ->groupBy("products.id")
            ->orderByDesc("products.id")
            ->offset($request->skip)
            ->limit($request->limit)
            ->get();
        if (count($products) != 0) {
            $products = $products->map(function ($item) {
                $category = Category::find($item->category_id);
                $item->name  = !empty(getTranslation($item->id)) ? getTranslation($item->id) : $item->name;
                $item->cat_name  = $category->getTranslation("name");
                return $item;
            });
        }

        $categories = Category::all();
        $brands = Brand::all();

        if (count($categories) != 0) {
            $categories = $categories->map(function ($item) {
                $item->name  = $item->getTranslation("name");

                return $item;
            });
        }
        if (count($brands) != 0) {
            $brands = $brands->map(function ($item) {
                $item->name  = $item->getTranslation("name");

                return $item;
            });
        }

        return response()->json([
            "products" => $products,
            "counter" => ceil(empty((float)$counter[0]->counter) ? 0 : (float)$counter[0]->counter),
            "rows" => round(empty((int)$counter[0]->rowss) ? 0 : (int)$counter[0]->rowss),
            "categories" => $categories,
            "brands" => $brands,
            "request" => $request->all()

        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function seller_products(Request $request)
    {
        $col_name = null;
        $query = null;
        $seller_id = null;
        $sort_search = null;
        $products = Product::where('added_by', 'seller');
        if ($request->has('user_id') && $request->user_id != null) {
            $products = $products->where('user_id', $request->user_id);
            $seller_id = $request->user_id;
        }
        if ($request->search != null) {
            $products = $products
                ->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }
        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            $products = $products->orderBy($col_name, $query);
            $sort_type = $request->type;
        }

        $products = $products->where('digital', 0)->orderBy('created_at', 'desc')->paginate(15);
        $type = 'Seller';

        return view('backend.product.products.index', compact('products', 'type', 'col_name', 'query', 'seller_id', 'sort_search'));
    }

    public function all_products(Request $request, $type = null)

    {


        // if ($type == null) {





        //     $col_name = null;
        //     $query = null;
        //     $seller_id = null;
        //     $sort_search = null;

        //     $query = DB::table('products')
        //         ->join('users', function ($join) {
        //             $join->on('users.id', '=', 'products.user_id');
        //         });

        //     if ($request->has("product_name") && $request->product_name != "") {
        //         $query = $query->where('products.name', 'like', '%' . $request->product_name . '%');
        //     }

        //     // if ($request->has("product_tag")) {
        //     //     $tags =
        //     //     $query = $query->where('products.tag', 'like', '%' . $request->product_tag . '%');
        //     // }
        //     if ($request->has("product_price") && $request->product_price != "") {
        //         $query = $query->where('products.unit_price', 'like', '%' . $request->product_price . '%');
        //     }
        //     if ($request->has("category_id") && $request->category_id != "") {
        //         $query = $query->where('products.category_id',  $request->category_id);
        //     }

        //     if ($request->has("brand_id") && $request->brand_id != "") {
        //         $query = $query->where('products.brand_id',  $request->brand_id);
        //     }
        //     $products =  $query->select('products.id')
        //         ->paginate(15);

        //     $type = 'All';

        return view('backend.product.products.index');
        // } else {


        //     $col_name = null;
        //     $query = null;
        //     $seller_id = null;
        //     $sort_search = null;
        //     $products =  DB::table('products');

        //     if ($request->has("search")) {

        //         $products = $products
        //             ->join('users', function ($join) {
        //                 $join->on('users.id', '=', 'products.user_id');
        //             })
        //             ->where('products.name', 'like', '%' . $request->search . '%')
        //             ->orWhere('products.description', 'like', '%' . $request->search . '%')
        //             ->select('products.id');


        //         // return dd($products);

        //         // if (count($products->get()) == 0) {
        //         //     $products = DB::table('products')
        //         //         ->join('categories', function ($join) use ($request) {
        //         //             $join->on('products.category_id', '=', 'categories.id')
        //         //                 ->where("categories.name", 'like', '%' . $request->search . '%');
        //         //         })
        //         //         ->join('users', function ($join) {
        //         //             $join->on('users.id', '=', 'products.user_id');
        //         //         })
        //         //         ->select('products.id');
        //         // }
        //     }
        //     //return dd($products_data);


        //     $products =  $products->paginate(15);


        //     // $products = $products->paginate(15);
        //     $type = 'All';

        //     return view('backend.product.products.index', compact('products', 'type', 'col_name', 'query', 'seller_id', 'sort_search'));
        // }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();

        return view('backend.product.products.create', compact('categories'));
    }


    public static function auto_store_product($request)
    {

        $product = new Product;
        $product->name = $request->name;
        $product->added_by = $request->added_by;

        $product->user_id = $request->user_id;

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->current_stock = $request->current_stock;
        // $product->barcode = $request->barcode;

        $product->photos = $request->photos;
        $product->thumbnail_img = $request->thumbnail_img;
        $product->unit = $request->unit;
        $product->min_qty = $request->min_qty;
        $product->low_stock_quantity = $request->low_stock_quantity;
        $product->stock_visibility_state = $request->stock_visibility_state;

        //return json_decode($request->tags[0]);
        $tags = array();
        if ($request->tags[0] != null) {
            foreach ($request->tags[0] as $key => $tag) {
                //   return "sds";
                array_push($tags, $tag);
            }
        }
        $product->tags = implode(',', $tags);

        $product->description = $request->description;
        $product->video_provider = $request->video_provider;
        $product->video_link = $request->video_link;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        //        $product->tax = $request->tax;
        //        $product->tax_type = $request->tax_type;
        $product->discount = $request->discount;
        $product->discount_type = $request->discount_type;
        $product->shipping_type = $request->shipping_type;
        $product->est_shipping_days  = $request->est_shipping_days;

        if (property_exists($request, "shipping_type")) {
            if ($request->shipping_type == 'free') {
                $product->shipping_cost = 0;
            } elseif ($request->shipping_type == 'flat_rate') {
                $product->shipping_cost = $request->flat_shipping_cost;
            } elseif ($request->shipping_type == 'product_wise') {
                $product->shipping_cost = json_encode($request->shipping_cost);
            }
        }
        if ($request->has('is_quantity_multiplied')) {
            $product->is_quantity_multiplied = 1;
        }

        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        if ($request->has('meta_img')) {
            $product->meta_img = $request->meta_img;
        } else {
            $product->meta_img = $product->thumbnail_img;
        }

        if ($product->meta_title == null) {
            $product->meta_title = $product->name;
        }

        if ($product->meta_description == null) {
            $product->meta_description = strip_tags($product->description);
        }

        if ($product->meta_img == null) {
            $product->meta_img = $product->thumbnail_img;
        }

        if ($request->hasFile('pdf')) {
            $product->pdf = $request->pdf->store('uploads/products/pdf');
        }

        $product->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . Str::random(5);

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $product->colors = json_encode($request->colors);
        } else {
            $colors = array();
            $product->colors = json_encode($colors);
        }

        $choice_options = array();

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_' . $no;

                $item['attribute_id'] = $no;

                $data = array();
                foreach (json_decode($request[$str][0]) as $key => $eachValue) {
                    array_push($data, $eachValue->value);
                }

                $item['values'] = $data;
                array_push($choice_options, $item);
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        } else {
            $product->attributes = json_encode(array());
        }

        $product->choice_options = json_encode($choice_options, JSON_UNESCAPED_UNICODE);

        $product->published = 1;
        if ($request->button == 'unpublish' || $request->button == 'draft') {
            $product->published = 0;
        }

        if ($request->has('cash_on_delivery')) {
            $product->cash_on_delivery = 1;
        }
        if ($request->has('featured')) {
            $product->featured = 1;
        }
        if ($request->has('todays_deal')) {
            $product->todays_deal = 1;
        }
        $product->cash_on_delivery = 0;
        if ($request->cash_on_delivery) {
            $product->cash_on_delivery = 1;
        }
        //$variations = array();

        $product->save();

        //VAT & Tax
        if ($request->tax_id) {
            foreach ($request->tax_id as $key => $val) {
                $product_tax = new ProductTax;
                $product_tax->tax_id = $val;
                $product_tax->product_id = $product->id;
                $product_tax->tax = $request->tax[$key];
                $product_tax->tax_type = $request->tax_type[$key];
                $product_tax->save();
            }
        }
        //Flash Deal
        if ($request->flash_deal_id) {
            $flash_deal_product = new FlashDealProduct;
            $flash_deal_product->flash_deal_id = $request->flash_deal_id;
            $flash_deal_product->product_id = $product->id;
            $flash_deal_product->discount = $request->flash_discount;
            $flash_deal_product->discount_type = $request->flash_discount_type;
            $flash_deal_product->save();
        }

        //combinations start
        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                foreach (json_decode($request[$name][0]) as $key => $item) {
                    array_push($data, $item->value);
                }
                array_push($options, $data);
            }
        }


        //Generates the combinations of customer choice options
        $combinations = Combinations::makeCombinations($options);

        if (count($combinations[0]) > 0) {

            $product->variant_product = 1;
            foreach ($combinations as $key => $combination) {
                $str = '';

                foreach ($combination as $key => $item) {
                    if ($key > 0) {

                        $str .= '-' . str_replace(' ', '', $item);
                    } else {
                        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                            $color_name = \App\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        } else {
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();

                //dd($product_stock);

                if ($product_stock == null) {
                    $product_stock = new ProductStock;
                    $product_stock->product_id = $product->id;
                }

                //    return $request['price_'.str_replace('.', '_', $str)];
                $product_stock->variant = $str;
                $product_stock->price = (int)$request['price_' . str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_' . str_replace('.', '_', $str)];
                $product_stock->qty = (int)$request['qty_' . str_replace('.', '_', $str)];
                $product_stock->image = $request['img_' . str_replace('.', '_', $str)];
                $product_stock->save();
            }
        } else {

            // return $request->unit_price;
            $product_stock = new ProductStock;
            $product_stock->product_id = $product->id;
            $product_stock->price = $request->unit_price;
            $product_stock->qty = $request->current_stock;
            $product_stock->save();
        }
        //combinations end

        $product->save();

        return $product;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if (empty($request->refurbished_degree) && !empty($request->refurbished)) {
            flash(translate('Please Put Refurbished Degree'))->error();
            return back();
        }



        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();

        $product = new Product;
        $product->name = $request->name;
        $product->added_by = $request->added_by;
        if (Auth::user()->user_type == 'seller') {
            $product->user_id = Auth::user()->id;
        } else {
            $product->user_id = \App\User::where('user_type', 'admin')->first()->id;
        }

        // $product->user_id = $request->seller_id;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->current_stock = $request->current_stock;
        $product->barcode = $request->barcode;

        if ($refund_request_addon != null && $refund_request_addon->activated == 1) {
            if ($request->refundable != null) {
                $product->refundable = 1;
            } else {
                $product->refundable = 0;
            }
        }
        $product->photos = $request->photos;
        $product->thumbnail_img = $request->thumbnail_img;
        $product->unit = $request->unit;
        $product->min_qty = $request->min_qty;
        $product->low_stock_quantity = $request->low_stock_quantity;
        $product->stock_visibility_state = $request->stock_visibility_state;

        // return dd($request->all());
        $tags = array();
        if ($request->tags[0] != null) {


            foreach ($request->tags as $key => $tag) {
                // return dd($tag);
                array_push($tags, $tag);
            }
        }
        $product->tags = implode(',', $tags);

        $product->description = $request->description;
        $product->video_provider = $request->video_provider;
        $product->video_link = $request->video_link;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->featured = 0; //$request->featured;
        //        $product->tax = $request->tax;
        //        $product->tax_type = $request->tax_type;
        $product->discount = $request->discount;
        $product->discount_type = $request->discount_type;
        $product->shipping_type = $request->shipping_type;
        $product->est_shipping_days  = $request->est_shipping_days;

        if ($request->has('shipping_type')) {
            if ($request->shipping_type == 'free') {
                $product->shipping_cost = 0;
            } elseif ($request->shipping_type == 'flat_rate') {
                $product->shipping_cost = $request->flat_shipping_cost;
            } elseif ($request->shipping_type == 'product_wise') {
                $product->shipping_cost = json_encode($request->shipping_cost);
            }
        }
        if ($request->has('is_quantity_multiplied')) {
            $product->is_quantity_multiplied = 1;
        }
        if ($request->has('include_tax')) {
            $product->include_tax = $request->include_tax;
        }
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        if ($request->has('meta_img')) {
            $product->meta_img = $request->meta_img;
        } else {
            $product->meta_img = $product->thumbnail_img;
        }

        if ($product->meta_title == null) {
            $product->meta_title = $product->name;
        }

        if ($product->meta_description == null) {
            $product->meta_description = strip_tags($product->description);
        }

        if ($product->meta_img == null) {
            $product->meta_img = $product->thumbnail_img;
        }

        if ($request->hasFile('pdf')) {
            $product->pdf = $request->pdf->store('uploads/products/pdf');
        }

        $product->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . Str::random(5);

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $product->colors = json_encode($request->colors);
        } else {
            $colors = array();
            $product->colors = json_encode($colors);
        }

        $choice_options = array();

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_' . $no;

                $item['attribute_id'] = $no;

                $data = array();
                foreach (json_decode($request[$str][0]) as $key => $eachValue) {
                    array_push($data, $eachValue->value);
                }

                $item['values'] = $data;
                array_push($choice_options, $item);
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        } else {
            $product->attributes = json_encode(array());
        }

        $product->choice_options = json_encode($choice_options, JSON_UNESCAPED_UNICODE);

        $product->published = 1;
        if ($request->button == 'unpublish') {
            $product->published = 0;
        }

        if ($request->has('cash_on_delivery')) {
            $product->cash_on_delivery = 1;
        }
        if ($request->has('featured')) {
            $product->featured = 1;
        }

        if ($request->has('force_file')) {
            $product->force_file = 1;
            $product->show_file = 1;
        }
        if ($request->has('todays_deal')) {
            $product->todays_deal = 1;
        }
        $product->cash_on_delivery = 0;
        if ($request->cash_on_delivery) {
            $product->cash_on_delivery = 1;
        }
        //$variations = array();


        $product->save();
        if (!empty($request->refurbished_degree) && !empty($request->refurbished)) {
            $req = new Request([
                "product_id" => $product->id,
                "refurbished_degree_id" => $request->refurbished_degree
            ]);
            $refurbished = new RefurbishedProduct();
            $refurbished->create($req);
        }



        //VAT & Tax
        if ($request->tax_id) {
            foreach ($request->tax_id as $key => $val) {
                $product_tax = new ProductTax;
                $product_tax->tax_id = $val;
                $product_tax->product_id = $product->id;
                $product_tax->tax = $request->tax[$key];
                $product_tax->tax_type = $request->tax_type[$key];
                $product_tax->save();
            }
        }
        //Flash Deal
        if ($request->flash_deal_id) {
            $flash_deal_product = new FlashDealProduct;
            $flash_deal_product->flash_deal_id = $request->flash_deal_id;
            $flash_deal_product->product_id = $product->id;
            $flash_deal_product->discount = $request->flash_discount;
            $flash_deal_product->discount_type = $request->flash_discount_type;
            $flash_deal_product->save();
        }

        //combinations start
        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                foreach (json_decode($request[$name][0]) as $key => $item) {
                    array_push($data, $item->value);
                }
                array_push($options, $data);
            }
        }


        //Generates the combinations of customer choice options
        $combinations = Combinations::makeCombinations($options);

        if (count($combinations[0]) > 0) {

            $product->variant_product = 1;
            foreach ($combinations as $key => $combination) {
                $str = '';

                foreach ($combination as $key => $item) {
                    if ($key > 0) {

                        $str .= '-' . str_replace(' ', '', $item);
                    } else {
                        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                            $color_name = \App\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        } else {
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();


                if ($product_stock == null) {
                    $product_stock = new ProductStock;
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_' . str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_' . str_replace('.', '_', $str)];
                $product_stock->qty = $request['qty_' . str_replace('.', '_', $str)];
                $product_stock->image = $request['img_' . str_replace('.', '_', $str)];
                $product_stock->save();
            }
        } else {
            $product_stock = new ProductStock;
            $product_stock->product_id = $product->id;
            $product_stock->price = $request->unit_price;
            $product_stock->qty = $request->current_stock;
            $product_stock->save();
        }
        //combinations end

        $product->save();

        // Product Translations
        $product_translation = ProductTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'product_id' => $product->id]);
        $product_translation->name = $request->name;
        $product_translation->unit = $request->unit;
        $product_translation->description = $request->description;
        $product_translation->save();

        flash(translate('Product has been inserted successfully'))->success();

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            return redirect()->route('products.admin');
        } else {
            if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated) {
                $seller = Auth::user()->seller;
                $seller->remaining_uploads -= 1;
                $seller->save();
            }
            return redirect()->route('seller.products');
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
    public function admin_product_edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $lang =         $lang = $request->has("lang") ? $request->lang : Session::get('locale', Config::get('app.locale'));
        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('backend.product.products.edit', compact('product', 'categories', 'tags', 'lang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function seller_product_edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $lang =         $lang = $request->has("lang") ? $request->lang : Session::get('locale', Config::get('app.locale'));

        $tags = json_decode($product->tags);
        $categories = Category::all();
        return view('backend.product.products.edit', compact('product', 'categories', 'tags', 'lang'));
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

        if (empty($request->refurbished_degree) && !empty($request->refurbished)) {
            flash(translate('Please Put Refurbished Degree'))->error();
            return back();
        }


        $refund_request_addon       = \App\Addon::where('unique_identifier', 'refund_request')->first();
        $product                    = Product::findOrFail($id);
        $product->category_id       = $request->category_id;
        $product->brand_id          = $request->brand_id;
        $product->current_stock     = $request->current_stock;
        $product->barcode           = $request->barcode;
        $product->cash_on_delivery = 0;
        $product->featured = 0;
        $product->todays_deal = 0;
        $product->is_quantity_multiplied = 0;


        if ($refund_request_addon != null && $refund_request_addon->activated == 1) {
            if ($request->refundable != null) {
                $product->refundable = 1;
            } else {
                $product->refundable = 0;
            }
        }

        if ($request->lang == env("DEFAULT_LANGUAGE")) {
            $product->name          = $request->name;
            $product->unit          = $request->unit;
            $product->description   = $request->description;
            $product->slug          = strtolower($request->slug);
        }

        $product->photos                 = $request->photos;
        $product->thumbnail_img          = $request->thumbnail_img;
        $product->min_qty                = $request->min_qty;
        $product->low_stock_quantity     = $request->low_stock_quantity;
        $product->stock_visibility_state = $request->stock_visibility_state;

        $tags = array();
        if ($request->tags[0] != null) {
            foreach (json_decode($request->tags[0]) as $key => $tag) {
                array_push($tags, $tag->value);
            }
        }
        $product->tags           = implode(',', $tags);

        $product->video_provider = $request->video_provider;
        $product->video_link     = $request->video_link;
        $product->unit_price     = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        //        $product->tax            = $request->tax;
        //        $product->tax_type       = $request->tax_type;
        $product->discount       = $request->discount;
        $product->shipping_type  = $request->shipping_type;
        $product->est_shipping_days  = $request->est_shipping_days;
        if ($request->has('shipping_type')) {
            if ($request->shipping_type == 'free') {
                $product->shipping_cost = 0;
            } elseif ($request->shipping_type == 'flat_rate') {
                $product->shipping_cost = $request->flat_shipping_cost;
            } elseif ($request->shipping_type == 'product_wise') {
                $product->shipping_cost = json_encode($request->shipping_cost);
            }
        }
        if ($request->has('include_tax')) {
            $product->include_tax = $request->include_tax;
        }
        if ($request->has('is_quantity_multiplied')) {
            $product->is_quantity_multiplied = 1;
        }
        if ($request->has('cash_on_delivery')) {
            $product->cash_on_delivery = 1;
        }

        if ($request->has('featured')) {
            $product->featured = 1;
        }
        if ($request->has('force_file')) {
            $product->force_file = 1;
            $product->show_file = 1;
        } else {
            $product->force_file = 0;
            $product->show_file = 0;
        }

        if ($request->has('todays_deal')) {
            $product->todays_deal = 1;
        }

        $product->discount_type     = $request->discount_type;
        $product->meta_title        = $request->meta_title;
        $product->meta_description  = $request->meta_description;
        $product->meta_img          = $request->meta_img;

        if ($product->meta_title == null) {
            $product->meta_title = $product->name;
        }

        if ($product->meta_description == null) {
            $product->meta_description = strip_tags($product->description);
        }

        if ($product->meta_img == null) {
            $product->meta_img = $product->thumbnail_img;
        }

        $product->pdf = $request->pdf;

        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $product->colors = json_encode($request->colors);
        } else {
            $colors = array();
            $product->colors = json_encode($colors);
        }

        $choice_options = array();

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_' . $no;

                $item['attribute_id'] = $no;

                $data = array();
                foreach (json_decode($request[$str][0]) as $key => $eachValue) {
                    array_push($data, $eachValue->value);
                }

                $item['values'] = $data;
                array_push($choice_options, $item);
            }
        }

        foreach ($product->stocks as $key => $stock) {
            $stock->delete();
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        } else {
            $product->attributes = json_encode(array());
        }

        $product->choice_options = json_encode($choice_options, JSON_UNESCAPED_UNICODE);


        //combinations start
        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                foreach (json_decode($request[$name][0]) as $key => $item) {
                    array_push($data, $item->value);
                }
                array_push($options, $data);
            }
        }

        $combinations = Combinations::makeCombinations($options);
        if (count($combinations[0]) > 0) {
            $product->variant_product = 1;
            foreach ($combinations as $key => $combination) {
                $str = '';
                foreach ($combination as $key => $item) {
                    if ($key > 0) {
                        $str .= '-' . str_replace(' ', '', $item);
                    } else {
                        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                            $color_name = \App\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        } else {
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }

                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                if ($product_stock == null) {
                    $product_stock = new ProductStock;
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_' . str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_' . str_replace('.', '_', $str)];
                $product_stock->qty = $request['qty_' . str_replace('.', '_', $str)];
                $product_stock->image = $request['img_' . str_replace('.', '_', $str)];

                $product_stock->save();
            }
        } else {
            $product_stock              = new ProductStock;
            $product_stock->product_id  = $product->id;
            $product_stock->price       = $request->unit_price;
            $product_stock->qty         = $request->current_stock;
            $product_stock->save();
        }

        $product->save();

        if (!empty($request->refurbished_degree) && !empty($request->refurbished) && $product->refurbished == 1) {
            $req = new Request([
                "product_id" => $product->id,
                "refurbished_degree_id" => $request->refurbished_degree,
                "id" => $product->refurbished_product->id
            ]);
            $refurbished = new RefurbishedProduct();
            $refurbished->update($req);
        } else {
            if (!empty($product->refurbished_product) && $product->refurbished == 1 && empty($request->refurbished)) {
                $req = new Request([
                    "product_id" => $product->id,
                    "id" => $product->refurbished_product->id
                ]);
                $refurbished = new RefurbishedProduct();
                $refurbished->delete($req);
            } else if ($product->refurbished == 0 && !empty($request->refurbished)) {
                $req = new Request([
                    "product_id" => $product->id,
                    "refurbished_degree_id" => $request->refurbished_degree
                ]);
                $refurbished = new RefurbishedProduct();
                $refurbished->create($req);
            }
        }

        //Flash Deal
        if ($request->flash_deal_id) {
            if ($product->flash_deal_product) {
                $flash_deal_product = FlashDealProduct::findOrFail($product->flash_deal_product->id);
            }
            if (!$flash_deal_product) {
                $flash_deal_product = new FlashDealProduct;
            }
            $flash_deal_product->flash_deal_id = $request->flash_deal_id;
            $flash_deal_product->product_id = $product->id;
            $flash_deal_product->discount = $request->flash_discount;
            $flash_deal_product->discount_type = $request->flash_discount_type;
            $flash_deal_product->save();
            //            dd($flash_deal_product);
        }

        //VAT & Tax
        if ($request->tax_id) {
            ProductTax::where('product_id', $product->id)->delete();
            foreach ($request->tax_id as $key => $val) {
                $product_tax = new ProductTax;
                $product_tax->tax_id = $val;
                $product_tax->product_id = $product->id;
                $product_tax->tax = $request->tax[$key];
                $product_tax->tax_type = $request->tax_type[$key];
                $product_tax->save();
            }
        }

        // Product Translations
        $product_translation                = ProductTranslation::firstOrCreate(['lang' => $request->lang, 'product_id' => $product->id]);
        $product_translation->name          = $request->name;
        $product_translation->unit          = $request->unit;
        $product_translation->description   = $request->description;
        $product_translation->save();

        flash(translate('Product has been updated successfully'))->success();

        // Artisan::call('view:clear');
        // Artisan::call('cache:clear');

        return redirect()->route("products.all");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->num_of_sale > 0) {
            if ($product->archive == 1) {
                $product->archive = 0;
                $product->published = 1;
                $product->save();
            } else {
                $product->archive = 1;
                $product->published = 0;
                $product->save();
            }

            flash(translate('Product has been archived successfully'))->success();
            return back();
        } else {


            foreach ($product->product_translations as $key => $product_translations) {
                $product_translations->delete();
            }

            if (Product::destroy($id)) {

                flash(translate('Product has been deleted successfully'))->success();

                Artisan::call('view:clear');
                Artisan::call('cache:clear');

                if (Auth::user()->user_type == 'admin') {
                    return redirect()->route('products.admin');
                } else {
                    return redirect()->route('seller.products');
                }
            } else {
                flash(translate('Something went wrong'))->error();
                return back();
            }
        }
    }

    /**
     * Duplicates the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Request $request, $id)
    {
        $product = Product::find($id);
        $product_new = $product->replicate();
        $product_new->slug = substr($product_new->slug, 0, -5) . Str::random(5);
        $product_new->save();

        $product_taxes = ProductTax::where("product_id", $id)->first();

        $product_tax = new ProductTax;
        $product_tax->tax_id = $product_taxes->tax_id;
        $product_tax->product_id = $product_new->id;
        $product_tax->tax = $product_taxes->tax;
        $product_tax->tax_type = $product_taxes->tax_type;
        $product_tax->save();


        if ($product_new->save()) {
            flash(translate('Product has been duplicated successfully'))->success();
            if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
                if ($request->type == 'In House')
                    return redirect()->route('products.admin');
                elseif ($request->type == 'Seller')
                    return redirect()->route('products.seller');
                elseif ($request->type == 'All')
                    return redirect()->route('products.all');
            } else {
                return redirect()->route('seller.products');
            }
        } else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function get_products_by_brand(Request $request)
    {
        $products = Product::where('brand_id', $request->brand_id)->get();
        return view('partials.product_select', compact('products'));
    }

    public function updateTodaysDeal(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->todays_deal = $request->status;
        if ($product->save()) {
            return 1;
        }
        return 0;
    }

    public function updatePublished(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->published = $request->status;

        if ($product->added_by == 'seller' && \App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated) {
            $seller = $product->user->seller;
            if ($seller->invalid_at != null && Carbon::now()->diffInDays(Carbon::parse($seller->invalid_at), false) <= 0) {
                return 0;
            }
        }

        $product->save();
        return 1;
    }

    public function updateFeatured(Request $request)
    {

        $product = Product::findOrFail($request["id"]);
        $product->featured = $request["status"];
        if ($product->save()) {
            return 1;
        }
        return 0;
    }
    public function updateExclusive(Request $request)
    {

        $product = Product::findOrFail($request["id"]);
        $product->exclusive_to_website = $request["status"];
        if ($product->save()) {
            return 1;
        }
        return 0;
    }

    public function updateforce_file(Request $request)
    {

        $product = Product::findOrFail($request["id"]);
        $product->force_file = $request["status"];
        $product->show_file = $request["status"];

        if ($product->save()) {
            return 1;
        }
        return 0;
    }

    public function updateSellerFeatured(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->seller_featured = $request->status;
        if ($product->save()) {
            return 1;
        }
        return 0;
    }

    public function sku_combination(Request $request)
    {


        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->name;

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {

                $name = 'choice_options_' . $no;
                $data = array();
                foreach (json_decode($request[$name][0]) as $key => $item) {


                    array_push($data, $item->value);
                }
                Attributes::get_values($data, $no);

                array_push($options, $data);
            }
        }

        $combinations = Combinations::makeCombinations($options);
        return view('backend.product.products.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
    }




    public function sku_combination_edit(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $product_name = $request->name;
        $unit_price = $request->unit_price;

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                foreach (json_decode($request[$name][0]) as $key => $item) {
                    array_push($data, $item->value);
                }
                Attributes::get_values($data, $no);

                array_push($options, $data);
            }
        }

        $combinations = Combinations::makeCombinations($options);
        return view('backend.product.products.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
    }


    public function all_categories(Request $request)
    {
        $categories = DB::select('select name as label,id as value from categories');
        return response()->json([
            "categories" => $categories
        ]);
    }

    public function getProducts(Request $request)
    {
        $products = Product::skip($request->pagination)
            ->take(20);
        if ($request->name != "") {
            $products->where("name", 'like', '%' . $request->name . '%');
        } else if ($request->price != "") {
            $products->where("unit_price", $request->price);
        } else if ($request->color != "") {
            $products->where("colors", 'like', '%' . $request->color . '%');
        } else if ($request->category_id != "") {
            $products->where("category_id", $request->category_id);
        } else if ($request->tags != "") {
            $products->where("tags", 'like', '%' . $request->tags . '%');
        }
        $products = $products->get();

        $products = $products->map(function ($item, $key) {

            $item["price"] = home_price($item->id);
            $item["discount_price"] = home_discounted_price($item->id);
            $item["photo"] =  (!empty(Upload::find($item->photos))) ? Upload::find($item->photos)->file_name : null;
            $colors = [];
            foreach (json_decode($item->colors) as $color) {
                $color_name = Color::where("code", $color)->first();

                if (!empty($color_name)) {
                    $colors[] = $color_name->name;
                }
            }
            $item["colors"] =  $colors;

            $item["total_price"] =  ((total_price($item->id) - ($item->discount_type != "amount" ?  ((total_price($item->id) * $item->discount) / 100) : $item->discount)) * $item->min_qty);
            $item["currency_symbol"] =  currency_symbol();



            return $item;
        });
        return response()->json([
            "products" => $products
        ]);
    }




    public function getProductsData(Request $request)
    {
        $products = DB::table('products');


        // Product::skip($request->pagination)
        //     ->take(20);
        if ($request->name != "") {
            $products->where("name", 'like', '%' . $request->name . '%');
        }
        if ($request->price != "") {
            $products->where("unit_price", $request->price);
        }
        if ($request->category_id != "") {
            $products->where("category_id", $request->category_id);
        }
        if ($request->tags != "") {
            $products->where("tags", 'like', '%' . $request->tags . '%');
        }
        $products = $products
            ->select("products.id", "products.photos", "products.name")
            ->skip($request->pagination)
            ->take(10)
            ->get();


        $products = $products->map(function ($item, $key) {

            $item->price = home_price($item->id);
            $item->price_discount = home_discounted_price($item->id);

            $item->photo =  (!empty(Upload::find($item->photos))) ? Upload::find($item->photos)->file_name : null;



            return $item;
        });
        return response()->json([
            "products" => $products
        ]);
    }


    public function getProductsSeller(Request $request)
    {

        //   $products = DB::select("SELECT products.*
        //   FROM products
        //   INNER JOIN users ON products.user_id = users.id AND users.user_type = 'seller' AND users.id = $request->id

        //   ");

        $products = Seller::where("user_id", $request->id)->first()->products;


        $products = $products->map(function ($item, $key) {

            $item["price"] = home_price($item->id);
            $item["discount_price"] = home_discounted_price($item->id);
            $item["photo"] =  (!empty(Upload::find($item->photos))) ? Upload::find($item->photos)->file_name : null;
            $colors = [];
            foreach (json_decode($item->colors) as $color) {
                $color_name = Color::where("code", $color)->first();

                if (!empty($color_name)) {
                    $colors[] = $color_name->name;
                }
            }
            $item["colors"] =  $colors;

            $item["total_price"] =  ((total_price($item->id) - ($item->discount_type != "amount" ?  ((total_price($item->id) * $item->discount) / 100) : $item->discount)) * $item->min_qty);
            $item["currency_symbol"] =  currency_symbol();



            return $item;
        });
        return response()->json([
            "products" => $products
        ]);
    }


    public function all_products_js(Request $request)
    {
        return view('backend.product.products');
    }

    public function all_products_data(Request $request)
    {
        $all_products = DB::select("SELECT products.*,users.name AS seller,uploads.file_name AS photo FROM products
                                    JOIN users ON users.id = products.user_id
                                    JOIN uploads ON uploads.id = products.photos
                                    GROUP BY products.id LIMIT 100000");

        return response()->json([
            "products" => $all_products
        ]);
    }

    public function search_products(Request $request)
    {

        if ($request->type == "id") {
            $all_products = DB::select("SELECT products.*,users.name AS seller,uploads.file_name AS photo FROM products
                                    JOIN users ON users.id = products.user_id
                                    JOIN uploads ON uploads.id = products.photos
                                    WHERE products.id LIKE '%$request->value%'
                                    GROUP BY products.id ");
        } else if ($request->type == "name") {
            $all_products = DB::select("SELECT products.*,users.name AS seller,uploads.file_name AS photo FROM products
                                    JOIN users ON users.id = products.user_id
                                    JOIN uploads ON uploads.id = products.photos
                                    WHERE products.name LIKE '%$request->value%'
                                    GROUP BY products.id ");
        } else if ($request->type == "seller") {
            $all_products = DB::select("SELECT products.*,users.name AS seller,uploads.file_name AS photo FROM products
                                    JOIN users ON users.id = products.user_id
                                    JOIN uploads ON uploads.id = products.photos
                                    WHERE users.name LIKE '%$request->value%'
                                    GROUP BY products.id ");
        } else if ($request->type == "unit_price") {
            $all_products = DB::select("SELECT products.*,users.name AS seller,uploads.file_name AS photo FROM products
                                    JOIN users ON users.id = products.user_id
                                    JOIN uploads ON uploads.id = products.photos
                                    WHERE products.unit_price LIKE '%$request->value%'
                                    GROUP BY products.id ");
        } else if ($request->type == "created_at" && $request->starDate != null && $request->endDate != null) {
            $all_products = DB::select("SELECT products.*,users.name AS seller,uploads.file_name AS photo FROM products
                                    JOIN users ON users.id = products.user_id
                                    JOIN uploads ON uploads.id = products.photos
                                    WHERE products.created_at >= '$request->start_date'
                                    AND products.created_at <= '$request->end_date'
                                    GROUP BY products.id ");
        }


        return response()->json([
            "products" => $all_products
        ]);
    }

    public function update_product(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->name  = $request->product_name;
        $product->unit_price  = $request->product_price;
        $product->current_stock  = $request->product_quantity;
        $product->save();

        return response()->json([
            "products" => $product
        ]);
    }

    public function top_six_products(Request $request)
    {
        $products = DB::table('products')
            ->where("user_id", $request->user_id)
            ->select("products.*")
            ->orderBy('num_of_sale', 'desc')
            ->limit(6)
            ->get();

        $products = collect($products)->map(function ($item) {
            $item->photo = uploaded_asset($item->thumbnail_img);
            $item->price = home_discounted_base_price($item->id);
            // $item->rating = renderStarRating($item->rating);

            return $item;
        });

        return response()->json([
            "products" => $products,
            "style_price" => get_setting("style_price"),
            "style_price_del" => get_setting("style_price_del")

        ]);
    }


    public function related_product(Request $request)
    {
        // Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get()


        $products = DB::table('products')
            ->where('category_id', $request->category_id)
            ->where('id', '!=', $request->id)
            ->select("products.*")
            ->limit(10)
            ->get();


        $view = view("frontend.partials.related_products_section", [
            "products_data" => $products
        ])->render();
        return response()->json([
            "data" => $view
        ]);
    }




    public function getRattingShop(Request $request)
    {
        // Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get()


        $products = DB::select("SELECT sum(reviews.rating) as reviews_total,count(reviews.id) as reviews_count
                                                        FROM products
                                                         JOIN reviews ON  reviews.product_id = products.id
                                                         WHERE products.user_id = $request->user_id");



        $total = count($products) != 0 ? $products[0]->reviews_count : 0;
        $rating = count($products) != 0 ? $products[0]->reviews_total : 0;
        return response()->json([
            "total" => $total,
            "rating" => $rating

        ]);
    }
    public function show_archive()
    {
        return view("backend.product.archive");
    }


    public function products_data_archive(Request $request)
    {
        $symbol = translate(currency_symbol());

        $query  = DB::table('products')
            ->leftJoin("uploads", function ($join) {
                $join->on("uploads.id", "=", "products.thumbnail_img");
            })
            ->join("users", function ($join) {
                $join->on("users.id", "=", "products.user_id");
            })
            // ->join("product_stocks", function ($join) {
            //     $join->on("products.id", "=", "product_stocks.product_id");
            // })
            ->where("products.archive", 1)
            ->whereDate("products.created_at", ">=", $request->startDate)
            ->whereDate("products.created_at", "<=", $request->endDate);




        // if ($request->has("search") && $request->search != "") {

        //     $str = !$request->has("name") ? $request->search : $request->name;
        //     $query =    $query->where("products.name", 'like', "%$str%");
        // }
        if ($request->name != "" || $request->search != "") {
            if ($request->name != "") {

                $query =    $query->where("products.name", 'like', "%$request->name%");
            } else if ($request->search != ""  && !is_numeric($request->search)) {

                $query =    $query->where("products.name", 'like', "%$request->search%");
            }
        }

        if ($request->category_id != "") {

            $query =    $query->whereIn("products.category_id", Cat::children_cat($request->category_id));
        }
        if ($request->brand_id != "") {
            $query =    $query->where("products.brand_id", $request->brand_id);
        }
        // if ($request->user_name != "") {
        //     $query =    $query->where("users.name", 'like', "%$request->user_name%");
        // }


        $counter =   $query->select(
            DB::raw("COUNT(products.id) / $request->limit as counter"),
            DB::raw("COUNT(products.id) as rowss")
        )->get();

        $query = $query->select(
            'users.name as user_name',
            DB::raw("CONCAT(products.unit_price,' $symbol ') AS price"),
            // 'products.published',
            // 'products.featured',
            'products.name',
            'products.created_at',
            'products.id',
            'products.current_stock',
            'products.slug',
            'uploads.file_name as photo',

        );
        $products =  $query
            ->groupBy("products.id")
            ->orderByDesc("products.id")
            ->offset($request->skip)
            ->limit($request->limit)
            ->get();


        if (count($products) != 0) {
            $products = $products->map(function ($item) {
                $item->name  = !empty(getTranslation($item->id)) ? getTranslation($item->id) : $item->name;

                return $item;
            });
        }

        $categories = Category::all();
        $brands = Brand::all();

        if (count($categories) != 0) {
            $categories = $categories->map(function ($item) {
                $item->name  = $item->getTranslation("name");

                return $item;
            });
        }
        if (count($brands) != 0) {
            $brands = $brands->map(function ($item) {
                $item->name  = $item->getTranslation("name");

                return $item;
            });
        }

        return response()->json([
            "products" => $products,
            "counter" => ceil(empty((float)$counter[0]->counter) ? 0 : (float)$counter[0]->counter),
            "rows" => round(empty((int)$counter[0]->rowss) ? 0 : (int)$counter[0]->rowss),
            "categories" => $categories,
            "brands" => $brands,
            "request" => $request->all()

        ]);
    }


    public function product_setting()
    {

        $refurbished_degrees = RefurbishedDegree::all();

        return view("backend.setup_configurations.product_setting.index", [
            "refurbished_degrees" => $refurbished_degrees
        ]);
    }


    public function get_from_category_attrs(Request $request)
    {

        //$category =  Category::find($request->category_id);
        $attrs = Attributes::get_all_attrs_cats(Cat::get_all_parents($request->category_id));

        return view("backend.product.products.category_attributes", [
            "attributes" => $attrs
        ])->render();
    }
    public function get_from_category_attrs_update(Request $request)
    {

        $attrs = Attributes::get_all_attrs_cats(Cat::get_all_parents($request->category_id));
        $product =  Product::find($request->product_id);

        return view("backend.product.products.category_attributes_edit", [
            "attributes" => $attrs,
            "product" => $product
        ])->render();
    }


    public function set_optionce(Request $request)
    {

        return response()->json([
            "text" => put_values_attr($request->id)
        ]);
    }
}
