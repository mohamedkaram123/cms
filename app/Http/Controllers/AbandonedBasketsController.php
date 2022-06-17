<?php

namespace App\Http\Controllers;

use App\Http\Resources\back\AbandonedBasketCollection;
use App\Models\Cart;
use App\Models\Product;
use App\Upload;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class AbandonedBasketsController extends Controller
{

    public function index()
    {



        return view("backend.abandoned_baskets.index");
    }

    public function connect_php($dbname, $username, $password, $table)
    {

        $host = 'localhost';
        //   $dbname = 'test';
        //   $username = 'root';
        //   $password = '';

        $dsn = "mysql:host=$host;dbname=$dbname";
        // get all users
        $sql = "SELECT COUNT(match_id) AS match_id FROM $table;";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $stmt = $pdo->query($sql);

            if ($stmt === false) {
                die("Error");
            }

            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }




    public function all_carts(Request $request)
    {


        $symbol =  translate(currency_symbol());

        $carts_baskets = DB::select("SELECT concat('$symbol',SUM(carts.price)) AS prices,
                                      users.name,
                                      users.phone,
                                      users.id,
                                    uploads.file_name AS avatar,
                                      carts.created_at AS created_at,
                                      SUM(carts.quantity) AS quantity,
                                      products.name AS product_name,
                                      products.slug
                                       FROM carts
                                        INNER JOIN users ON users.id = carts.user_id
                                       INNER JOIN products ON products.id = carts.product_id
                                       INNER JOIN uploads ON uploads.id = products.photos
                                       GROUP BY users.name
                                       ORDER BY prices DESC
                                       ");



        return response()->json([
            "carts" => $carts_baskets
        ]);
        // return response()->json([
        //     "carts" => $data_map
        // ]);
    }

    public function all_baskets(Request $request)
    {

        $symbol = translate(currency_symbol());

        $carts_baskets = DB::select("SELECT concat(SUM(carts.price),' $symbol') AS prices,
                                      users.name,
                                      users.phone,
                                      users.id,
                                    uploads.file_name AS avatar,
                                      carts.created_at AS created_at,
                                      SUM(carts.quantity) AS quantity,
                                      products.name AS product_name,
                                      products.slug
                                       FROM carts
                                        INNER JOIN users ON users.id = carts.user_id
                                       INNER JOIN products ON products.id = carts.product_id
                                       INNER JOIN uploads ON uploads.id = products.photos
                                       GROUP BY users.name
                                       ORDER BY prices DESC
                                       LIMIT $request->limit
                                       OFFSET $request->offset
                                       ");



        return response()->json([
            "carts" => $carts_baskets,
        ]);
        // return response()->json([
        //     "carts" => $data_map
        // ]);
    }



    public function user_products(Request $request)
    {
        $symbol = currency_symbol();

        $carts =   DB::select("SELECT uploads.file_name AS photo ,
                    CONCAT('$symbol',(carts.price + carts.tax + carts.shipping_cost) * carts.quantity) AS price_cart,
                    carts.*,
                    products.name AS product_name,
                    products.slug AS product_slug

                    FROM carts
                    JOIN products ON products.id = carts.product_id
                    JOIN uploads ON uploads.id = products.photos
                    WHERE carts.user_id = $request->user_id
                    GROUP BY carts.id
                    ");

        return response()->json([
            "carts" => $carts
        ]);
    }

    public function search_abandoned_baskets(Request $request)
    {
        $symbol = currency_symbol();


        $query = DB::table('carts')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->join('products', 'products.id', '=', 'carts.product_id');





        if ($request->name != "") {
            $query =    $query->where("users.name", 'like', "%$request->name%");
        }

        if ($request->price != 0 && $request->price != null) {
            $query =    $query->where("SUM(carts.price)", 'like', "%$request->price%");
        }
        $carts = $query
            ->select(
                DB::raw("concat('$symbol',SUM(carts.price)) AS prices"),
                'users.name',
                'users.phone',
                'carts.created_at AS created_at',
                DB::raw('SUM(carts.quantity) AS quantity'),
                'products.name AS product_name',
                'products.slug'
            )
            ->groupBy('users.name')
            ->orderBy('name', 'desc')
            ->get();

        return response()->json([
            "carts" => $carts
        ]);
    }


    public function products_user(Request $request)
    {
        $symbol = currency_symbol();

        $carts_baskets = DB::select("SELECT products.name,
                                             products.slug,
                                            carts.quantity,
                                            concat('$symbol',carts.price) as price,
                                            concat('$symbol',carts.tax) as tax,
                                            concat('$symbol',carts.shipping_cost) as shipping_cost,
                                            uploads.file_name ,
                                            concat('$symbol',(carts.quantity * (carts.price + carts.tax + carts.shipping_cost))) as total_price
                                            from carts
                                     JOIN products ON products.id = carts.product_id
                                     JOIN uploads ON uploads.id = products.photos
                                     Where carts.user_id = $request->user_id");



        return response()->json([
            "products" => $carts_baskets
        ]);
    }
}
