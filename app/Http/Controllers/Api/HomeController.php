<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Home;

class HomeController extends Controller
{
    //

    public function get_sliders(Request $req)
    {
        $slides = Home::slides();
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $slides
        ]);
    }


    public function featured_categories(Request $req)
    {
        $featured_categories = Home::featured_categories($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $featured_categories
        ]);
    }

    public function home_banners1(Request $req)
    {
        $home_banners1 = Home::home_banners1($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $home_banners1
        ]);
    }

    public function home_banners2(Request $req)
    {
        $home_banners2 = Home::home_banners2($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $home_banners2
        ]);
    }


    public function home_banners3(Request $req)
    {
        $home_banners3 = Home::home_banners3($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $home_banners3
        ]);
    }

    public function featured_products(Request $req)
    {
        $featured_products = Home::featured_products($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $featured_products
        ]);
    }

    public function best_selling(Request $req)
    {
        $best_selling = Home::best_selling($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $best_selling
        ]);
    }

    public function last_products(Request $req)
    {
        $last_products = Home::last_products($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $last_products
        ]);
    }

    public function home_categories(Request $req)
    {
        $home_categories = Home::home_categories($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $home_categories
        ]);
    }

    public function top_10_categories(Request $req)
    {
        $top_10_categories = Home::top_10_categories($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $top_10_categories
        ]);
    }

    public function top_10_brands(Request $req)
    {
        $top_10_brands = Home::top_10_brands($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $top_10_brands
        ]);
    }

    public function headers(Request $req)
    {
        $headers = Home::headers($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $headers
        ]);
    }


    public function widgets(Request $req)
    {
        $widgets = Home::widgets($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $widgets
        ]);
    }
    public function footer_data_desc(Request $req)
    {
        $footer_data_desc = Home::footer_data_desc($req);
        return response()->json([
            "msg" => "done",
            "status" => 1,
            "data" => $footer_data_desc
        ]);
    }
}
