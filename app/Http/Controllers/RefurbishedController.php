<?php

namespace App\Http\Controllers;

use App\MyClasses\RefurbishedDegree;
use App\MyClasses\RefurbishedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RefurbishedController extends Controller
{
    //
    public $refurbishedProduct;
    public $refurbishedDegree;

    public function __construct()
    {
        $this->refurbishedProduct = new RefurbishedProduct();
        $this->refurbishedDegree = new RefurbishedDegree();
    }
    protected function validator_refurbished(array $data)
    {



        return Validator::make(
            $data,
            [
                "refurbished_degree_id" => "required"
            ],
            [
                "refurbished_degree_id.required" => translate("please enter degree")
            ]
        );
    }
    public function create_refurbished_product(Request $req)
    {


        $validate =   $this->validator_refurbished($req->all());

        if ($validate->fails()) {
            return response()->json([
                "status" => 0,
                "msg" => $validate->errors()
            ]);
        }

        $data =   $this->refurbishedProduct->create($req);

        return  response()->json([
            "status" => 1,
            "msg" => "done",
            "data" => $data
        ]);
    }
    public function update_refurbished_product(Request $req)
    {
        $data =   $this->refurbishedProduct->update($req);

        return  response()->json([
            "status" => 1,
            "msg" => "done",
            "data" => $data
        ]);
    }
    public function delete_refurbished_product(Request $req)
    {
        $data =   $this->refurbishedProduct->delete($req);

        return  response()->json([
            "status" => 1,
            "msg" => "done",
            "data" => $data
        ]);
    }
    public function create_refurbished_degree(Request $req)
    {


        $data =   $this->refurbishedDegree->create($req);
        flash(translate('the refurbished degree is added'))->success();

        return back();
    }
    public function update_refurbished_degree(Request $req)
    {
        $data =   $this->refurbishedDegree->update($req);

        return response()->json([
            "status" => 1,
            "msg" => "done",
            "data" => $data
        ]);
    }
    public function delete_refurbished_degree(Request $req)
    {
        $data =   $this->refurbishedDegree->delete($req);

        flash(translate('deleted refurbished degree is successfully'))->success();

        return back();
    }


    public function get_refurbished_degrees()
    {
        $data =   $this->refurbishedDegree->all();
        return response()->json([
            "status" => 1,
            "msg" => "done",
            "data" => $data
        ]);
    }
}
