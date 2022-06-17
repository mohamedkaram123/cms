<?php

namespace App\MyClasses;

use App\Models\Product;
use App\Models\RefurbishedProduct as ModelsRefurbishedProduct;
use Illuminate\Http\Request;

class RefurbishedProduct
{

    public  function create(Request $req)
    {

        $refurbished = new ModelsRefurbishedProduct();
        $refurbished->product_id = $req->product_id;
        $refurbished->refurbished_degree_id = $req->refurbished_degree_id;
        $refurbished->save();

        $product = Product::find($req->product_id);
        $product->refurbished = 1;
        $product->save();
        return $refurbished;
    }


    public  function update(Request $req)
    {
        $refurbished =  ModelsRefurbishedProduct::find($req->id);
        $refurbished->product_id = $req->product_id;
        $refurbished->refurbished_degree_id = $req->refurbished_degree_id;
        $refurbished->save();
        return $refurbished;
    }


    public  function delete(Request $req)
    {
        $refurbished =  ModelsRefurbishedProduct::find($req->id);

        $product = Product::find($refurbished->product_id);
        $product->refurbished = 0;
        $product->save();

        $refurbished->delete();
    }
}
