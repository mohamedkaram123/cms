<?php

namespace App\MyClasses;

use App\Attribute as AppAttribute;
use App\Category;
use App\Models\AttributeCategory;
use App\Models\AttributeValue;
use App\Product;
use Attribute;

class Attributes
{

    public static function get_values($data, $attr_id)
    {
        foreach ($data as $item) {
            self::check_value($item, $attr_id);
        }
    }

    public static function check_value($value, $attr_id)
    {
        $attr_value = AttributeValue::where("attribute_id", $attr_id)->where("value", $value)->first();
        if (empty($attr_value)) {
            self::create_value([
                "attribute_id" => $attr_id,
                "value" => $value
            ]);
        }
    }

    public static function create_value($req)
    {
        $attribute = new AttributeValue();
        $attribute->attribute_id = $req["attribute_id"];
        $attribute->value = $req["value"];

        $attribute->save();
    }

    public static function get_attrs($cat_id)
    {
        $attrs_cat = AttributeCategory::where("category_id", $cat_id)->get();
        $attrs = [];
        foreach ($attrs_cat as $item) {
            $attrs[] = $item->attr;
        }

        return $attrs;
    }

    public static function get_attrs_and_attrs_child($cat_id)
    {
        // $attributes = array();


        $cats = Cat::get_all_children($cat_id);
        array_push($cats, Category::find($cat_id));
        $arr_merge = [];
        if (!empty($cats)) {
            foreach ($cats as $cat_items) {
                $attrs = self::get_attrs($cat_items->id);
                $arr_merge = array_merge($arr_merge, $attrs);
            }
        }
        return $arr_merge;
    }

    public static function get_values_list(AppAttribute $attr)
    {
        $attr_value = [];
        if (!empty($attr->values)) {
            foreach ($attr->values as $item) {
                $attr_value[] = $item->value;
            }
        }
        return $attr_value;
    }

    public static function get_values_product($attr_id, $product_id)
    {
        $product = Product::find($product_id);
        $values = [];
        foreach (json_decode($product->attributes, true) as $attribute_id) {
            if ($attribute_id == $attr_id) {
                foreach (json_decode($product->choice_options, true) as $key => $item) {
                    if ($item["attribute_id"] == $attr_id) {
                        $values = $item["values"];
                    }
                }
                return $values;
            }
        }
        return [];
    }

    public static function get_all_attrs_cats($cats)
    {
        $attrs = [];
        foreach ($cats as $cat) {
            $attrs = array_merge($attrs, self::get_attrs($cat->id));
        }
        return $attrs;
    }
}
