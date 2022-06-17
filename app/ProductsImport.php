<?php

namespace App;

use App\Http\Controllers\AizUploadController;
use App\Product;
use App\User;
use App\ProductTax;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Auth;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {

        $aiz = new AizUploadController();
        $file2 = $aiz->upload_path($row["photo"] != "" ? $row["photo"] : "https://via.placeholder.com/150.jpg");

        $product =   new Product();

        $product->name   = $row['name'];
        $product->added_by    = Auth::user()->user_type == 'seller' ? 'seller' : 'admin';
        $product->user_id    = Auth::user()->user_type == 'seller' ? Auth::user()->id : User::where('user_type', 'admin')->first()->id;
        $product->category_id    = $row['category_id'];
        $product->brand_id    = $row['brand_id'];
        $product->video_provider    = "youtube";
        $product->video_link    = "";
        $product->unit_price    = $row['unit_price'];
        $product->purchase_price    = $row['purchase_price'] == null ? $row['unit_price'] : $row['purchase_price'];
        $product->unit    = $row['unit'];
        $product->current_stock = $row['current_stock'];
        $product->meta_title = $row['meta_title'];
        $product->meta_description = $row['meta_description'];
        $product->exclusive_to_website = $row['exclusive_to_website'] == "" ? 0 : $row['exclusive_to_website'];
        $product->colors = json_encode(array());
        $product->choice_options = json_encode(array());
        $product->variations = json_encode(array());
        $product->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $row['slug'])) . '-' . Str::random(5);
        $product->thumbnail_img = $file2->id;
        $product->photos = $file2->id;

        $product->save();

        $tax = new ProductTax();
        $tax->tax_id = 1;
        $tax->product_id = $product->id;
        $tax->tax = 15;
        $tax->tax_type = "percent";
        $tax->save();


        return $product;
    }

    public function rules(): array
    {
        return [
            // Can also use callback validation rules
            'unit_price' => function ($attribute, $value, $onFailure) {
                if (!is_numeric($value)) {
                    $onFailure('Unit price is not numeric');
                }
            }
        ];
    }

    public function downloadThumbnail($url)
    {
        try {
            $extension = pathinfo($url, PATHINFO_EXTENSION);
            $filename = 'uploads/all/' . Str::random(5) . '.' . $extension;
            $fullpath = 'public/' . $filename;
            $file = file_get_contents($url);
            file_put_contents($fullpath, $file);

            $upload = new Upload;
            $upload->extension = strtolower($extension);

            $upload->file_original_name = $filename;
            $upload->file_name = $filename;
            $upload->user_id = Auth::user()->id;
            $upload->type = "image";
            $upload->file_size = filesize(base_path($fullpath));
            $upload->save();

            return $upload->id;
        } catch (\Exception $e) {
            //dd($e);
        }
        return null;
    }
}
