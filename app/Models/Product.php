<?php

namespace App\Models;

use App\FlashDealProduct;
use App\ProductTax;
use App\User;
use App\Wishlist;
use App\Models\SpecialOfferProduct;
use App\ProductTranslation;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['current_stock', 'variations', 'num_of_sale'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $product_translations = $this->hasMany(ProductTranslation::class)->where('lang', $lang)->first();
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('published', 1);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // public function taxes()
    // {
    //     return $this->hasMany(ProductTax::class);
    // }
    public function taxe()
    {
        return $this->hasOne(ProductTax::class);
    }
    public function spcial_product()
    {
        return $this->hasOne(SpecialOfferProduct::class, "object_id")->where("type", "product")->latest();
    }
    public function flash_deal_product()
    {
        return $this->hasOne(FlashDealProduct::class);
    }
    public function refurbished_product()
    {
        return $this->hasOne(RefurbishedProduct::class, "product_id");
    }
}
