<?php

namespace App\MyClasses;

use App\Models\Order;
use App\Models\OrderNote;
use App\Models\Product;
use App\Upload;
use Illuminate\Support\Facades\Session;

class OrdersNotes
{
    public static function put_session_photos($req)
    {
        if ($req->note != "" || $req->photos2 != "") {

            $photos2 = [];
            if ($req->photos2 != "" && $req->photos2 != null) {
                $photos2 = explode(",", $req->photos2);
            }

            Session::put('note_order', [
                "photos" => $photos2,
                "note" => $req->note
            ]);
        }
    }
    public static function put_session_OrderTypePharmacy($req)
    {

        Session::put('oreder_type_pharmacy', $req->recipe);
    }

    public static function save_oreder_type_pharmacy($order_id)
    {
        try {
            if (Session::has("oreder_type_pharmacy")) {
                $oreder_type_pharmacy = Session::get("oreder_type_pharmacy");
                $order = Order::find($order_id);
                $order->oreder_type_pharmacy = $oreder_type_pharmacy;
                $order->save();
                Session::forget('oreder_type_pharmacy');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public static function save_note_and_photos_order($order_id)
    {
        try {
            $order_notes = Session::get("note_order");
            if (count($order_notes["photos"]) > 0 || $order_notes["note"] != "") {
                $order_note = new OrderNote();
                $order_note->files = count($order_notes["photos"]) > 0 ? json_encode($order_notes["photos"]) : null;
                $order_note->note = $order_notes["note"] != "" ? $order_notes["note"] : null;
                $order_note->order_id = $order_id;
                $order_note->save();
            }
            Session::forget('note_order');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public static function check_order_note($order_id)
    {
        $check = false;
        if (!empty(OrderNote::where("order_id", $order_id)->first())) {
            $check = true;
        }
        return $check;
    }

    public static function save_order_note($req)
    {
        $photos = [];
        if ($req->photos != "" && $req->photos != null) {
            $photos = explode(",", $req->photos);
        }
        $order_note = new OrderNote();
        $order_note->files = count($photos) > 0 ? json_encode($photos) : null;
        $order_note->note = $req->note != "" ? $req->note : null;
        $order_note->order_id = $req->order_id;
        $order_note->save();
    }


    public static function get_order_notes($order_id)
    {
        $order_note = OrderNote::where("order_id", $order_id)->first();
        $order_note->files = self::get_all_uploads(json_decode($order_note->files, true));
        return $order_note;
    }

    public static function get_all_uploads($photos)
    {

        $photos = $photos ?? [];
        $uploads = [];
        if (count($photos) > 0) {
            foreach ($photos as $photo_id) {
                $uploads[] = Upload::find($photo_id);
            }
        }
        return $uploads;
    }

    public static function check_order_note_photos($product_id)
    {
        $check_data = false;
        $product = Product::find($product_id);
        $check_files = $product->force_file == 1 ? true : false;
        if ($check_files) {
            if (session()->has("note_order")) {
                $order_notes = session()->get("note_order");
                if (count($order_notes["photos"]) == 0) {
                    $check_data = true;
                }
            } else {
                $check_data = true;
            }
        }

        return $check_data;
    }
}
