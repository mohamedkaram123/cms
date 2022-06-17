<?php

namespace App\Models;

use App\Category;
use App\Product;
use App\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialOfferProduct extends Model
{
    protected $table = "special_offers_product";

    protected $appends = ["product", "category", "end_date"];



    public function getProductAttribute()
    {
        if ($this->type == "product") {

            $product = Product::find($this->object_id);
            $product->photos = !empty(Upload::find($product->photos)) ? url("/public") . "/" .  Upload::find($product->photos)->file_name : null;
            return $product;
        }
        return null;
        // $this->belongsTo(Product::class, "object_id")->where("type", "product");
    }


    public function getEndDateAttribute()
    {

        if ($this->specialOffers->end_date > now()) {
            return 1;
        }

        return 0;
    }

    /**
     * Get the user that owns the SpecialOfferProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specialOffers()
    {
        return $this->belongsTo(SpecialOffer::class, 'special_offers_id');
    }

    public function getCategoryAttribute()
    {
        if ($this->type == "category") {
            $category = Category::find($this->object_id);
            $category->banner = !empty(Upload::find($category->banner)) ? url("/public") . "/" . Upload::find($category->banner)->file_name : null;
            return $category;
        }

        return null;
        //   return $this->belongsTo(Category::class, "object_id")->where("type", "category");
    }
    
        /**
     * Get the user that owns the SpecialOfferProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'object_id');
    }
}
