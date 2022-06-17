<?php

namespace App\MyClasses;

use App\Models\Category;
use App\Models\Product;
use App\Brand;

class Cat
{

    public static function children_cat($cat_id)
    {

        $ids = [$cat_id];
        $Cat_ids = Category::where("parent_id", $cat_id)->get('id');
        if (count($Cat_ids) != 0) {
            foreach ($Cat_ids as $key => $value) {
                $ids[] =  $value["id"];
            }
        }
        return $ids;
    }


    public static function check_cat_children($cat_id)
    {

        $Cat_ids = Category::where("parent_id", $cat_id)->get('id');
        if (count($Cat_ids) != 0) {
            return true;
        }
        return false;
    }


    public static function check_cat_products($cat_id)
    {

        $cat_count = Product::where("category_id", $cat_id)->count();
        if ($cat_count >  0) {
            return true;
        }
        return false;
    }

    public static function get_brands($products)
    {
        $brands_ids = [];
        $brands = [];
        foreach ($products as $item) {
            if (!empty($item->brand_id)) {
                $brands_ids[] = $item->brand_id;
            }
        }
        foreach (array_unique($brands_ids) as $item) {
            $brands[] = Brand::find($item);
        }

        return $brands;
    }

    public static function get_main_parent($cargory_id)
    {
        $cat = Category::find($cargory_id);

        for ($i = 0; $i <= $cat->level; $i++) {
            if ($cat->parent_id > 0) {
                $cat = Category::where("id", $cat->parent_id)->first();
            }
        }
        return $cat;
    }
    public static function get_all_parents($cargory_id)
    {
        $cat = Category::find($cargory_id);
        $parents = [$cat];
        for ($i = 0; $i <= $cat->level; $i++) {
            if ($cat->parent_id > 0) {
                $cat = Category::where("id", $cat->parent_id)->first();
                $parents[] = $cat;
            }
        }
        return $parents;
    }
    // public static function get_all_children($cargory_id)
    // {
    //     $all_childrens = [];
    //     $cats = Category::where("parent_id",$cargory_id)->get();
    //     $all_childrens []= $cats;

    //         for ($i = 0; $i <= count($cats) ; $i++) {

    //                 $cats = Category::where("parent_id", $cats[$i]->id)->get();
    //          $all_childrens[] = $cats;

    //         }


    //     return $cat;
    // }

    public static  function get_all_children($id)
    {
        $items = Category::where("parent_id", $id)->get();

        //return $items;
        $kids = [];
        if (count($items) != 0) {
            foreach ($items as  $item) {
                if ($item['parent_id'] === $id) {
                    $kids[] = $item;

                    array_push($kids, ...self::get_all_children($item->id));
                }
            }
        }

        return $kids;
    }
}
