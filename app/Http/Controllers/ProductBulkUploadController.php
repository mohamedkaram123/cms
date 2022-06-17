<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\Brand;
use App\User;
use Auth;
use App\ProductsImport;
use App\ProductsExport;
use PDF;
use Excel;
use Illuminate\Support\Str;

class ProductBulkUploadController extends Controller
{


    public function __construct()
    {
        ini_set('max_execution_time', 300);
        ini_set("memory_limit", "512M");
    }
    public function index()
    {
        if (Auth::user()->user_type == 'seller') {
            return view('frontend.user.seller.product_bulk_upload.index');
        } elseif (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            return view('backend.product.bulk_upload.index');
        }
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function pdf_download_category()
    {

        $categories = Category::all();

        return PDF::loadView('backend.downloads.category', [
            'categories' => $categories,
        ], [], [])->download('category.pdf');
    }

    public function pdf_download_brand()
    {
        $brands = Brand::all();

        return PDF::loadView('backend.downloads.brand', [
            'brands' => $brands,
        ], [], [])->download('brands.pdf');
    }

    public function pdf_download_seller()
    {
        $users = User::where('user_type', 'seller')->get();

        return PDF::loadView('backend.downloads.user', [
            'users' => $users,
        ], [], [])->download('user.pdf');
    }

    public function bulk_upload(Request $request)
    {
        try {


            if ($request->hasFile('bulk_file')) {
                Excel::import(new ProductsImport, request()->file('bulk_file'));
            }
            flash(translate('Products imported successfully'))->success();
            return back();
        } catch (\Throwable $th) {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
}