<?php

namespace App\Api\Classes;

use App\Models\Brand;
use App\Product as ModelsProduct;

class Product
{
    public $brand_photo, $rate, $discount_price, $before_discount_price, $discount_percent, $discount_amount;
    protected  $product_discount;

    public function __construct($product)
    {

        $product_model = ModelsProduct::find($product->id);
        $this->product_discount = show_product_discount($product_model);

        $this->brand_photo = $this->img_brand_product($product_model);
        $this->rate = $this->renderStarRate($product_model);
        $this->before_discount_price = home_base_price($product_model->id);
        $this->discount_price = home_discounted_base_price($product_model->id);
        $this->discount_percent = $this->discount_percent_fun();
        $this->discount_amount = $this->discount_amount_fun();
        $this->thumbnail_img = $this->img_product($product_model);
        $this->refurbished_img = $this->refurbished_img_fun($product_model);
        $this->slug = url("") . "/product/" . $product_model->slug;
        $this->name = $product_model->getTranslation('name');

        $this->refurbished_name = $this->refurbished_name_fun($product_model);
        $this->refurbished_desc = $this->refurbished_desc_fun($product_model);
    }

    public function img_brand_product($product)
    {
        $brand_id =  $product->brand_id ?? null;
        if (!empty($brand_id)) {
            $brand = Brand::find($brand_id);
            return photo($brand->logo);
        }
        return null;
    }


    public function img_product($product)
    {
        $thumbnail_img =  $product->thumbnail_img;
        if (!empty($thumbnail_img)) {
            return photo($thumbnail_img);
        }
        return null;
    }


    public function discount_amount_fun()
    {
        return format_price(convert_price($this->product_discount['discount_amount']));
    }

    public function discount_percent_fun()
    {
        return  $this->product_discount['discount_percent'] . '%';
    }

    public function renderStarRate($product)
    {
        $rating = $product->rating;
        $maxRating = 5;
        $rating = $rating <= $maxRating ? $rating : $maxRating;
        return $rating;
    }

    public function refurbished_img_fun($product_Modal)
    {
        $logo = $product_Modal->refurbished_product->degree->logo ?? null;

        return !empty($logo) ? uploaded_asset($logo) : null;
    }

    public function refurbished_name_fun($product_Modal)
    {
        $name = $product_Modal->refurbished_product->degree->name ?? null;

        return $name;
    }


    public function refurbished_desc_fun($product_Modal)
    {
        $desc = $product_Modal->refurbished_product->degree->desc ?? null;

        return $desc;
    }
}
