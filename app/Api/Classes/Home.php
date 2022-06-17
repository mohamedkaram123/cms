<?php

namespace App\Api\Classes;

use App\Models\Brand;
use App\Models\Category;
use App\MyClasses\BusinessSettings;
use App\Upload;
use App\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class Home
{
    public function slides()
    {
        $slider_images = json_decode(get_setting('home_slider_images'), true);
        $imgs = [];
        foreach ($slider_images as $img) {
            $imgs[] = static_asset(Upload::find($img)->file_name);
        }
        return $imgs;
    }

    public function featured_categories()
    {
        $featured_categories = Category::where('featured', 1)->get();

        return $featured_categories;
    }

    public function home_banners1()
    {
        $data = [];
        $imgs = json_decode(get_setting('home_banner1_images'));
        $links = json_decode(get_setting('home_banner1_links'));
        if (count($imgs) != 0 && count($links) != 0) {
            if (count($imgs) == count($links)) {
                for ($i = 0; $i < count($imgs); $i++) {
                    $data[$i]["img"] = $imgs[$i];
                    $data[$i]["link"] = $links[$i];
                }
            }
        }



        return $data;
    }


    public function home_banners2()
    {
        $data = [];
        $imgs = json_decode(get_setting('home_banner2_images'));
        $links = json_decode(get_setting('home_banner2_links'));
        if (count($imgs) != 0 && count($links) != 0) {
            if (count($imgs) == count($links)) {
                for ($i = 0; $i < count($imgs); $i++) {
                    $data[$i]["img"] = $imgs[$i];
                    $data[$i]["link"] = $links[$i];
                }
            }
        }



        return $data;
    }

    public function home_banners3()
    {

        $data = [];
        $imgs = json_decode(get_setting('home_banner3_images'));
        $links = json_decode(get_setting('home_banner3_links'));
        $imgs_headers = json_decode(get_setting('home_banner3_header_imgs'));
        $txt_links = json_decode(get_setting('home_banner3_txt_link'));

        if (count($imgs) != 0 && count($links) != 0 && count($imgs_headers) != 0 && count($txt_links) != 0) {
            if (count($imgs) == count($links) && count($imgs) == count($imgs_headers) && count($imgs) == count($txt_links)) {
                for ($i = 0; $i < count($imgs); $i++) {
                    $home_banner3_header_imgs_trans = get_general_trans('business_settings_home_banner3', $i, 'home_banner3_header_imgs');
                    $home_banner3_links_trans = get_general_trans('business_settings_home_banner3', $i, 'home_banner3_txt_link');
                    $data[$i]["img"] = $imgs[$i];
                    $data[$i]["link"] = $links[$i];
                    $data[$i]["title_header"] = $home_banner3_header_imgs_trans;
                    $data[$i]["title_link"] = $home_banner3_links_trans;
                }
            }
        }



        return $data;
    }

    public function featured_products($req)
    {

        $lang = $req->header("Accept-Language");

        $features = DB::table('products')
            ->where("published", 1)
            ->where("featured", 1)
            ->select("products.id", "products.slug", "products.thumbnail_img")
            ->orderByRaw('RAND()')
            ->limit(12)
            ->get();

        $features = $features->map(function ($item) use ($lang) {

            foreach ((new Product($item)) as $key => $value) {
                $item->{$key} = $value;
            }
            $item->name = getTranslation($item->id, $lang) ?? $item->name;
            return $item;
        });



        return $features;
    }


    public function best_selling($req)
    {
        $lang = $req->header("Accept-Language");


        $top_12_products =
            DB::table('products')
            ->select("name", "slug", "id", "thumbnail_img", "rating", "refurbished")
            ->where("published", 1)
            ->orderBy('num_of_sale', 'desc')
            ->limit(12)
            ->get();


        $top_12_products = $top_12_products->map(function ($item) use ($lang) {
            foreach ((new Product($item)) as $key => $value) {
                $item->{$key} = $value;
            }
            $item->name = getTranslation($item->id, $lang) ?? $item->name;
            return $item;
        });
        return $top_12_products;
    }

    public function last_products($req)
    {
        $lang = $req->header("Accept-Language");

        $last_products = DB::table('products')

            ->select("products.id", "products.slug", "products.thumbnail_img", "products.rating", "products.name", "products.refurbished")
            ->orderBy('id', 'desc')
            ->limit(12)
            ->get();

        $last_products = $last_products->map(function ($item) use ($lang) {
            foreach ((new Product($item)) as $key => $value) {
                $item->{$key} = $value;
            }
            $item->name = getTranslation($item->id, $lang) ?? $item->name;
            return $item;
        });

        return $last_products;
    }

    public function home_categories($req)
    {
        $lang = $req->header("Accept-Language");

        $data = [];
        $home_categories = json_decode(get_setting('home_categories'));
        if (count($home_categories) != 0) {
            foreach ($home_categories as $key => $value) {
                $cat  = Category::find($value);
                $cat->name =  getTranslationCat($cat->id, $lang) ?? $cat->name;

                $products = get_cached_products($cat->id);
                $data[$key]["category"] = $cat;
                $data[$key]["category"]["products"] = $products;
            }
        }

        return $data;
    }


    public function
    top_10_categories($req)
    {
        $lang = $req->header("Accept-Language");

        $top10_categories_data = [];
        if (get_setting('top10_categories') != null && count(json_decode(get_setting('top10_categories'))) != 0) {
            $top10_categories = json_decode(get_setting('top10_categories'));
            foreach ($top10_categories as $key => $value) {
                $category = Category::find($value);
                $category->name =  getTranslationCat($category->id, $lang) ?? $category->name;

                $top10_categories_data[] = $category;
            }
        }

        return $top10_categories_data;
    }


    public function top_10_brands()
    {
        $top10_brands_data = [];
        if (get_setting('top10_brands') != null && count(json_decode(get_setting('top10_brands'))) != 0) {
            $top10_brands = json_decode(get_setting('top10_brands'));
            foreach ($top10_brands as $key => $value) {
                $brand = Brand::find($value);
                $top10_brands_data[] = $brand;
            }
        }

        return $top10_brands_data;
    }

    public function headers($req)
    {
        $lang = $req->header("Accept-Language");

        $header_data = [];
        $header_menu_labels =  json_decode(get_setting('header_menu_labels'), true);
        if (count($header_menu_labels) != 0 || $header_menu_labels != null) {
            foreach ($header_menu_labels as $key => $value) {
                $header_data[$key]["label"] = translate($value, $lang);
                $header_data[$key]["link"] = BusinessSettings::get_link($value, $key);
                $header_data[$key]["color"] = json_decode(get_setting('header_menu_colors'), true)[$key];
            }
        }


        return $header_data;
    }

    public function widgets($req)
    {
        $lang = $req->header("Accept-Language");


        $widgets = [];
        $widget_one_labels = get_setting('widget_one_labels');
        if ($widget_one_labels != null) {
            $widgets["widget_one"]["widget_title"] = translate(get_setting('widget_three'));
            foreach (json_decode($widget_one_labels, true) as $key => $value) {
                $widgets["widget_one"]["widget_one_links"][] = json_decode(get_setting('widget_one_links'), true)[$key];
                $widgets["widget_one"]["widget_one_label"][] =  translate($value, $lang);
            }
        }

        $widget_two_labels = get_setting('widget_two_labels');
        if ($widget_two_labels != null) {
            $widgets["widget_two"]["widget_title"] = translate(get_setting('widget_three'));

            foreach (json_decode($widget_two_labels, true) as $key => $value) {
                $widgets["widget_two"]["widget_two_links"][] = json_decode(get_setting('widget_two_links'), true)[$key];
                $widgets["widget_two"]["widget_two_label"][] =  translate($value, $lang);
            }
        }


        $widget_three_labels = get_setting('widget_three_labels');
        if ($widget_three_labels != null) {
            $widgets["widget_three"]["widget_title"] = translate(get_setting('widget_three'));

            foreach (json_decode($widget_three_labels, true) as $key => $value) {
                $widgets["widget_three"]["widget_three_links"][] = json_decode(get_setting('widget_three_links'), true)[$key];
                $widgets["widget_three"]["widget_three_label"][] =  translate($value, $lang);
            }
        }


        return $widgets;
    }


    public function footer_data_desc($req)
    {
        $lang = $req->header("Accept-Language");

        $data = [];
        $link_footer_des = json_decode(get_setting('footer_links_descriptions'), true);
        $link_footer_title = json_decode(get_setting('footer_links_title'), true);

        if (count($link_footer_title) > 0  && count($link_footer_des) > 0) {

            $data["terms"]["link"] =  route('terms');
            $data["terms"]["title"] =  translate($link_footer_title[0], $lang);
            $data["terms"]["descreption"] =  translate($link_footer_des[0], $lang);


            $data["return_policay"]["link"] =  route('returnpolicy');
            $data["return_policay"]["title"] =  translate($link_footer_title[1], $lang);
            $data["return_policay"]["descreption"] =  translate($link_footer_des[1], $lang);


            $data["support_policay"]["link"] =  route('supportpolicy');
            $data["support_policay"]["title"] =  translate($link_footer_title[2], $lang);
            $data["support_policay"]["descreption"] =  translate($link_footer_des[2], $lang);


            $data["privacy_policay"]["link"] =  route('privacypolicy');
            $data["privacy_policay"]["title"] =  translate($link_footer_title[3], $lang);
            $data["privacy_policay"]["descreption"] =  translate($link_footer_des[3], $lang);
        }

        return $data;
    }
}
