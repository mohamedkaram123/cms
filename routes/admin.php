<?php

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register admin routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

use App\City;
use App\Customer;
use App\Http\Controllers\AbandonedBasketsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\BusinessSettingsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewerOrderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FirebasController;
use App\Http\Controllers\GeneralTransController;
use App\Http\Controllers\FlashDealController;

use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\LocalShipmentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderSettingController;
use App\Http\Controllers\OrdersLogController;
use App\Http\Controllers\TabpaymentController;
use App\Http\Controllers\PayTabController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RefundRequestController;
use App\Http\Controllers\ReminderBasketController;
use App\Http\Controllers\SpecialOfferController;
use App\Http\Controllers\SellerController;
use App\Models\City as ModelsCity;
use App\Models\Governorate;
use App\Models\LocalSipmentAddress;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\PriceSystem;
use App\Models\RefundRequest;
use App\Models\Role;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Review;
use App\Seller;
use App\Upload;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


Route::get(
    'test2',
    function (Request $request) {



        return dd(json_decode(get_setting("extension_upload")));
    }
);
Route::post('/update', 'UpdateController@step0')->name('update');
Route::get('/update/step1', 'UpdateController@step1')->name('update.step1');
Route::get('/update/step2', 'UpdateController@step2')->name('update.step2');

Route::post('admin/trans_data', function (Request $request) {

    return translate_data($request->data);
});

Route::get('/error/role', function () {

    return view("backend.roles");
})->name("error.role");

Route::get('/admin', 'HomeController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::group(['prefix' => 'admin', 'middleware' => ['Roles', 'auth', 'admin']], function () {
    //Update Routes






    Route::get('test3', function (Request $request) {


        $sessions = session()->all();

        return dd(auth()->check());

        $time =  strtotime("1619913600");

        return dd($time);
        $products = DB::table('products');
        $products = $products
            ->select("products.id", "products.photos")
            ->skip($request->pagination)
            ->take(10)
            ->get();
        $products = $products->map(function ($item, $key) {

            $item->price = home_discounted_price($item->id);
            $item->photo =  (!empty(Upload::find($item->photos))) ? Upload::find($item->photos)->file_name : null;



            return $item;
        });
        return dd($products);

        $special_offer = new SpecialOfferController();
        return dd($special_offer->show_special_offer_cart());

        return dd(auth()->user()->temp_discount);
        // $reviews_data = [];
        // foreach ($reviews as $review) {
        //     $review
        // }

    });


    Route::get('/test', function (Request $request) {

        $array = \DB::table('sellers')
            ->where("verification_status", 1)
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'sellers.user_id');
            })
            ->join('shops', function ($join) {
                $join->on('shops.user_id', '=', 'users.id');
            })
            ->join('products', function ($join) {
                $join->on('products.user_id', '=', 'users.id');
            })
            ->select(\DB::raw("sum('products.num_of_sale') as num_of_sale"), "sellers.id")
            ->limit(20)
            ->get();

        return dd($array);

        // $customers = User::where("email_verified_at", null)->where("user_type", "customer")->get();
        // foreach ($customers as $customer) {

        //     $customer->email_verified_at = now();
        //     $customer->save();
        // }
        // return "done";
    });

    Route::get(
        'test4',
        [HomeController::class, 'get_top_products']
    );
    Route::get(
        '/tester',
        function () {

            $users = DB::table('users')
                ->leftJoin("orders", function ($join) {
                    $join->on("users.id", "=", "orders.user_id");
                });

            // if (!empty($request->data["user_type"])) {
            //     $user_type = $request->data["user_type"];
            //     $users =   $users->where("users.user_type", $user_type);
            // }

            // ->where("orders.delivery_status", $delivery_status)
            $users =   $users->where("orders.created_at", ">", "2020-12-31")
                ->where("orders.created_at", "<", "2021-12-05")
                ->select("users.email", "users.phone")
                ->get()
                ->toArray();


            return dd($users);


            LocalSipmentAddress::factory()->count(200)->create();
            return "dsds";
        }



        // function (Request $request) {


        //     $sellers = Seller::skip(3805)->take(1000000)->get();

        //     foreach ($sellers as $seller) {
        //         // return dd($seller->user_id);

        //         for ($i = 0; $i < 10; $i++) {

        //             $tag = json_encode([
        //                 "value" => "product" . $seller->id
        //             ]);
        //             $photos =  rand(16, 117);
        //             $price = rand(20, 1000);
        //             $discount = rand(10, 100);
        //             $data = [
        //                 "seller_id" => $seller->user_id,
        //                 "added_by" => User::find($seller->user_id)->name,
        //                 "name" => "product" . $seller->id . $i,
        //                 "category_id" => rand(1, 7),
        //                 "brand_id" => rand(1, 7),
        //                 "unit" => "pc",
        //                 "min_qty" => "1",
        //                 "tags" =>  [
        //                     0 => $tag
        //                 ],
        //                 "photos" =>  $photos,
        //                 "thumbnail_img" => $photos,
        //                 "video_provider" => "youtube",
        //                 "video_link" => null,
        //                 "unit_price" => $price,
        //                 "purchase_price" => $price,
        //                 "discount" => $discount,
        //                 "discount_type" => "amount",
        //                 "current_stock" => 100,
        //                 "description" => null,
        //                 "pdf" => null,
        //                 "meta_title" => null,
        //                 "meta_description" => null,
        //                 "meta_img" => null,
        //                 "shipping_type" => "free",
        //                 "flat_shipping_cost" => "0",
        //                 "shipping_cost" =>  [
        //                     "cairo" => "0",
        //                     "alargantin" => "0"
        //                 ],
        //                 "low_stock_quantity" => "1",
        //                 "stock_visibility_state" => "quantity",
        //                 "cash_on_delivery" => "1",
        //                 "flash_deal_id" => null,
        //                 "flash_discount" => "0",
        //                 "flash_discount_type" => null,
        //                 "est_shipping_days" => null,
        //                 "tax_id" =>  [
        //                     0 => "3"
        //                 ],
        //                 "tax" => [
        //                     0 => "0"
        //                 ],
        //                 "tax_type" =>  [
        //                     0 => "amount"
        //                 ],
        //                 "button" => "publish"
        //             ];

        //             $product = new ProductController();
        //             $product->store(new Request($data));
        //         }
        //     }

        //     return "Done";
        // }
    );



    Route::get('testBolla', function () {
        return dd("Dssd");
        $array = \DB::table('sellers')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'sellers.user_id');
            })
            ->join('products', function ($join) {
                $join->on('products.user_id', '=', 'users.id');
            })
            ->where("verification_status", 1)
            ->select(\DB::raw("sum('products.num_of_sale') as num_of_sale"), "sellers.id")
            ->limit(100)
            ->get();

        return dd($array);
    });





    Route::get('trans/{key}', function ($key) {
        return translate($key);
    });

    Route::get('setting/{key}', function ($key) {
        return get_setting($key);
    });

    Route::post('convert_price', function (Request $request) {
        return   convert_price_object($request->prices);
    });
    Route::get('pusher', [NotificationController::class, 'index'])->name("pusher.index");

    Route::get('get_notification', [NotificationController::class, 'get_notifications']);
    Route::post('delete_notify', [NotificationController::class, 'delete_notify']);
    Route::get('/delete/all/notify', [NotificationController::class, 'delete_all_notify']);

    // Route::post('trans_data', function (Request $request) {

    //     return translate_data($request->data);
    // });


    Route::post('setting_data', function (Request $request) {

        return setting_data($request->data);
    });


    Route::post('set_setting_data', function (Request $request) {

        return set_setting_data($request->data);
    });

    ///genenral trans
    Route::get('/genenral_trans/index/{table_name}/{row_id}', [GeneralTransController::class, 'index'])->name("genenral_trans.index");
    Route::patch('/genenral_trans/update', [GeneralTransController::class, 'update'])->name("genenral_trans.update");


    Route::post('saveData/setting/paytabs/egypt', [BusinessSettingsController::class, 'save_setting_paytabs_egypt']);
    Route::post('saveData/setting/paytabs/saudi', [BusinessSettingsController::class, 'save_setting_paytabs_saudi']);
    Route::post('saveData/setting/fawry/setting', [BusinessSettingsController::class, 'save_setting_fawry']);


    //Order Setting

    Route::get('/order/setting', [OrderSettingController::class, 'index'])->name("order.setting");
    Route::post('/order/setting/status/store', [OrderSettingController::class, 'store_status_order'])->name("order.status.store");
    Route::post('/order/setting/status/update', [OrderSettingController::class, 'update_status_order'])->name("order.status.update");


    Route::get('/order/setting/status/destroy/{id}', [OrderSettingController::class, 'destroy_order_status'])->name("order.status.destroy");
    Route::post('/order/setting/refund_days', [OrderSettingController::class, 'refund_days'])->name("order.refund_days.update");



    //=============================================== start aws payment services routes ===============================================//

    // Route::get('/test', 'HomeController@test_payment');

    //=============================================== end aws payment services routes ===============================================//


    Route::resource('categories', 'CategoryController');
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
    Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');

    Route::resource('brands', 'BrandController');
    Route::get('/brands/edit/{id}', 'BrandController@edit')->name('brands.edit');
    Route::get('/brands/destroy/{id}', 'BrandController@destroy')->name('brands.destroy');

    Route::get('/products/all_categories', [ProductController::class, 'all_categories']);
    Route::post('/products/getProducts', [ProductController::class, 'getProducts']);
    Route::post('/products/getProductsSeller', [ProductController::class, 'getProductsSeller']);
    Route::post('/products/getProductsData', [ProductController::class, 'getProductsData']);
    Route::post('/products/products_data', [ProductController::class, 'products_data']);
    Route::post('/products/products_data_archive', [ProductController::class, 'products_data_archive']);
    Route::get('/products/show_archive', [ProductController::class, 'show_archive'])->name("products.archive");


    Route::get('/products/get_from_category_attrs/{category_id}', [ProductController::class, 'get_from_category_attrs'])->name("products.get_from_category_attrs");
    Route::post('/products/get_from_category_attrs_update', [ProductController::class, 'get_from_category_attrs_update'])->name("products.get_from_category_attrs_update");
    Route::get('/products/admin/{id}/edit', 'ProductController@admin_product_edit')->name('products.admin.edit');

    Route::get('/products/set_optionce/{id}', [ProductController::class, 'set_optionce']);





    Route::get('/products', [ProductController::class, 'all_products_js'])->name("products_js");
    Route::get('/products/all_products', [ProductController::class, 'all_products_data'])->name("products.all");

    Route::post('/products/update_product', [ProductController::class, 'update_product']);
    Route::post('/products/search_products', [ProductController::class, 'search_products']);


    Route::get('/products/admin', 'ProductController@admin_products')->name('products.admin');
    Route::get('/products/seller', 'ProductController@seller_products')->name('products.seller');
    Route::get('/products/all', 'ProductController@all_products')->name('products.all');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::get('/products/admin/{id}/edit', 'ProductController@admin_product_edit')->name('products.admin.edit');
    Route::get('/products/seller/{id}/edit', 'ProductController@seller_product_edit')->name('products.seller.edit');
    Route::post('/products/todays_deal', 'ProductController@updateTodaysDeal')->name('products.todays_deal');
    Route::post('/products/featured', 'ProductController@updateFeatured')->name('products.featured');
    Route::post('/products/get_products_by_subcategory', 'ProductController@get_products_by_subcategory')->name('products.get_products_by_subcategory');

    Route::post('/cart/add_carts', [CartController::class, 'add_carts']);



    Route::resource('sellers', 'SellerController');
    Route::get('sellers_ban/{id}', 'SellerController@ban')->name('sellers.ban');
    Route::get('/sellers/destroy/{id}', 'SellerController@destroy')->name('sellers.destroy');
    Route::get('/sellers/view/{id}/verification', 'SellerController@show_verification_request')->name('sellers.show_verification_request');
    Route::get('/sellers/approve/{id}', 'SellerController@approve_seller')->name('sellers.approve');
    Route::get('/sellers/reject/{id}', 'SellerController@reject_seller')->name('sellers.reject');
    Route::get('/sellers/login/{id}', 'SellerController@login')->name('sellers.login');
    Route::get('/sellers/loginjs/{id}', 'SellerController@loginjs');


    Route::post('/sellers/payment_modal', 'SellerController@payment_modal')->name('sellers.payment_modal');
    Route::get('/seller/payments', 'PaymentController@payment_histories')->name('sellers.payment_histories');
    Route::get('/seller/payments/show/{id}', 'PaymentController@show')->name('sellers.payment_history');
    Route::get('/seller/payments/showjs/{id}', 'PaymentController@showjs');

    Route::get('/seller/{id}/editjs', 'SellerController@editjs');


    Route::get('/seller/sellersjs', [SellerController::class, 'sellersjs'])->name('sellers.indexjs');
    Route::get('/seller/getSellers', [SellerController::class, 'sellers']);
    Route::post('/seller/search_sellers', [SellerController::class, 'search_sellers']);
    Route::get('/seller/seller_profile', [SellerController::class, 'seller_profile']);
    Route::post('/seller/sellers_data', [SellerController::class, 'sellers_data']);



    Route::get('governorates', [GovernorateController::class, 'index'])->name("governorates.index");

    Route::post('/governorate/governorate_data', [GovernorateController::class, 'governorate_data']);
    Route::get('/governorate/countries', [GovernorateController::class, 'countries']);
    Route::post('/governorate/sendData', [GovernorateController::class, 'sendData']);
    Route::get('/governorate/destroy/{id}', [GovernorateController::class, 'destroy']);



    ///local shipment
    Route::get('/localShipment', [LocalShipmentController::class, 'index'])->name("localShipment.index");
    Route::post('/local_shipment/local_shipment_data', [LocalShipmentController::class, 'local_shipment_data']);
    Route::get("/localShipment/countries", [LocalShipmentController::class, "get_countries"]);

    Route::get('/localShipment/governorates/{id}', [LocalShipmentController::class, 'get_governorates']);
    Route::get('/localShipment/cities/{id}', [LocalShipmentController::class, 'get_cities']);
    Route::post('/localShipment/add/address', [LocalShipmentController::class, 'send_data']);
    Route::get('/localShipment/edit/{id}', [LocalShipmentController::class, 'edit_Address']);
    Route::post('/localShipment/update/address', [LocalShipmentController::class, 'update_Address']);
    Route::get("/localShipment/address/{id}", [LocalShipmentController::class, "delete_address"]);


    Route::get('/customers/customersjs', [CustomerController::class, 'customersjs'])->name('customers.indexjs');

    Route::get('/customers/getCustomers', [CustomerController::class, 'customers']);

    Route::resource('customers', 'CustomerController');
    Route::get('customers_ban/{customer}', 'CustomerController@ban')->name('customers.ban');
    Route::get('customers_banjs/{customer}', 'CustomerController@banjs');

    Route::get('/customers/login/{id}', 'CustomerController@login')->name('customers.login');
    Route::get('/customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');

    Route::get('/customers/destroyjs/{id}', 'CustomerController@destroyjs')->name('customers.destroy');


    Route::post('/customers/getCustomers', [CustomerController::class, 'getCustomers']);
    Route::post('/customers/search_customers', [CustomerController::class, 'search_customers']);

    Route::get('/customers/customerOrders/{id}', [CustomerController::class, 'CustomerOrders']);
    Route::get('/customers_count', [CustomerController::class, 'customers_count']);
    Route::get('/customer_profile/{customer_id}', [CustomerController::class, 'customer_profile']);
    Route::post('/customer/customers_data', [CustomerController::class, 'customers_data']);
    Route::post('/customer/msg_add_cart', [CustomerController::class, 'msg_add_cart']);




    // Route::view('/{path?}', 'backend.customer.customers.customerjs');

    // Route::view('/{path?}', 'backend.customer.customers.customerjs')
    //     ->where('path', 'customer/customer_profile/.*');

    // Route::view('/{path?}', 'backend.sellers.sellersjs')
    //     ->where('path', 'seller/seller_profile');

    // Route::view('/{path?}', 'backend.special_offers.index')
    //     ->where('path', 'sapecialOffers/new_spcial_offers');


    Route::get('/newsletter', 'NewsletterController@index')->name('newsletters.index');
    Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');
    Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');
    Route::post('sendMail', [NewsletterController::class, "sendMail"]);
    Route::post('sendMails', [NewsletterController::class, "sendMails"]);

    Route::post('sendMainMails', [NewsletterController::class, "sendMainMails"]);




    Route::resource('profile', 'ProfileController');

    Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
    Route::post('/business-settings/update/footer', 'BusinessSettingsController@update_footer')->name('business.footer');

    Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
    Route::get('/general-setting', 'BusinessSettingsController@general_setting')->name('general_setting.index');
    Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');
    Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
    Route::get('/file_system', 'BusinessSettingsController@file_system')->name('file_system.index');
    Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
    Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
    Route::get('/google-recaptcha', 'BusinessSettingsController@google_recaptcha')->name('google_recaptcha.index');

    //Facebook Settings
    Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
    Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
    Route::get('/facebook-comment', 'BusinessSettingsController@facebook_comment')->name('facebook-comment');
    Route::post('/facebook-comment', 'BusinessSettingsController@facebook_comment_update')->name('facebook-comment.update');
    Route::post('/facebook_pixel', 'BusinessSettingsController@facebook_pixel_update')->name('facebook_pixel.update');

    Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
    Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
    Route::post('/google_recaptcha', 'BusinessSettingsController@google_recaptcha_update')->name('google_recaptcha.update');
    //Currency
    Route::get('/currency', 'CurrencyController@currency')->name('currency.index');
    Route::post('/currency/update', 'CurrencyController@updateCurrency')->name('currency.update');
    Route::post('/your-currency/update', 'CurrencyController@updateYourCurrency')->name('your_currency.update');
    Route::get('/currency/create', 'CurrencyController@create')->name('currency.create');
    Route::post('/currency/store', 'CurrencyController@store')->name('currency.store');
    Route::post('/currency/currency_edit', 'CurrencyController@edit')->name('currency.edit');
    Route::post('/currency/update_status', 'CurrencyController@update_status')->name('currency.update_status');

    //Tax
    Route::resource('tax', 'TaxController');
    Route::get('/tax/edit/{id}', 'TaxController@edit')->name('tax.edit');
    Route::get('/tax/destroy/{id}', 'TaxController@destroy')->name('tax.destroy');
    Route::post('tax-status', 'TaxController@change_tax_status')->name('taxes.tax-status');


    Route::get('/verification/form', 'BusinessSettingsController@seller_verification_form')->name('seller_verification_form.index');
    Route::post('/verification/form', 'BusinessSettingsController@seller_verification_form_update')->name('seller_verification_form.update');
    Route::get('/vendor_commission', 'BusinessSettingsController@vendor_commission')->name('business_settings.vendor_commission');
    Route::post('/vendor_commission_update', 'BusinessSettingsController@vendor_commission_update')->name('business_settings.vendor_commission.update');

    Route::resource('/languages', 'LanguageController');
    Route::post('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
    Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
    Route::post('/languages/update_rtl_status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
    Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');
    Route::get('/languages/export_trans/{lang}', 'LanguageController@export_trans')->name('TransExport');
    Route::post('/languages/import_trans', 'LanguageController@import_trans')->name('ImportTrans');

    // website setting
    Route::group(['prefix' => 'website'], function () {
        Route::view('/header', 'backend.website_settings.header')->name('website.header');
        Route::view('/footer', 'backend.website_settings.footer')->name('website.footer');
        Route::view('/pages', 'backend.website_settings.pages.index')->name('website.pages');
        Route::view('/appearance', 'backend.website_settings.appearance')->name('website.appearance');
        Route::resource('custom-pages', 'PageController');
        Route::get('/custom-pages/edit/{id}', 'PageController@edit')->name('custom-pages.edit');
        Route::get('/custom-pages/user/login', 'PageController@show_custom_login')->name('custom-pages.user.login');
        Route::get('/custom-pages/user/register', 'PageController@show_custom_register')->name('custom-pages.user.register');

        Route::get('/custom-pages/destroy/{id}', 'PageController@destroy')->name('custom-pages.destroy');
    });

    Route::resource('roles', 'RoleController');
    Route::post('/roles/checks', 'RoleController@checks');

    Route::get('/roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
    Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

    Route::resource('staffs', 'StaffController');
    Route::get('/staff/check_old_password_get', 'StaffController@get_old_password')->name("staffs.check_old_password_get");
    Route::post('/staff/check_old_password', 'StaffController@set_old_password')->name("staffs.check_old_password");

    Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');

    Route::resource('flash_deals', 'FlashDealController');
    Route::get('/flash_deals/edit/{id}', 'FlashDealController@edit')->name('flash_deals.edit');
    Route::get('/flash_deals/destroy/{id}', 'FlashDealController@destroy')->name('flash_deals.destroy');
    Route::post('/flash_deals/update_status', 'FlashDealController@update_status')->name('flash_deals.update_status');
    Route::post('/flash_deals/update_featured', 'FlashDealController@update_featured')->name('flash_deals.update_featured');
    Route::post('/flash_deals/product_discount', 'FlashDealController@product_discount')->name('flash_deals.product_discount');
    Route::post('/flash_deals/product_discount_edit', 'FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');
    Route::post('/flash_deals/serch/product/discount', [FlashDealController::class, 'search_product_discount'])->name("search.product.list.discount");
    Route::post('/flash_deals/serch/product/discount/list', [FlashDealController::class, 'search_product_discount_list'])->name("search.product.list.discount.list");


    //Subscribers
    Route::get('/subscribers', 'SubscriberController@index')->name('subscribers.index');
    Route::get('/subscribers/destroy/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

    // Route::get('/orders', 'OrderController@admin_orders')->name('orders.index.admin');
    // Route::get('/orders/{id}/show', 'OrderController@show')->name('orders.show');
    // Route::get('/sales/{id}/show', 'OrderController@sales_show')->name('sales.show');
    // Route::get('/sales', 'OrderController@sales')->name('sales.index');
    //Newer Orders
    Route::get('/NewerOrders/index', [NewerOrderController::class, 'index'])->name('NewerOrders.index');
    Route::get('/NewerOrders/all_orders', [NewerOrderController::class, 'all_orders']);
    Route::post('/NewerOrders/search_orders', [NewerOrderController::class, 'search_orders']);
    Route::get('/NewerOrders/new_order', [NewerOrderController::class, 'new_order'])->name("admin.new_order");

    Route::post('/NewerOrders/orders_data', [NewerOrderController::class, 'orders_data']);


    // All Orders
    Route::get('/all_orders', 'OrderController@all_orders')->name('all_orders.index');
    Route::get('/all_orders/{id}/show', 'OrderController@all_orders_show')->name('all_orders.show');

    // Inhouse Orders
    Route::get('/inhouse-orders', 'OrderController@admin_orders')->name('inhouse_orders.index');
    Route::get('/inhouse-orders/{id}/show', 'OrderController@show')->name('inhouse_orders.show');

    // Seller Orders
    Route::get('/seller_orders', 'OrderController@seller_orders')->name('seller_orders.index');
    Route::get('/seller_orders/{id}/show', 'OrderController@seller_orders_show')->name('seller_orders.show');

    // Pickup point orders
    Route::get('orders_by_pickup_point', 'OrderController@pickup_point_order_index')->name('pick_up_point.order_index');
    Route::get('/orders_by_pickup_point/{id}/show', 'OrderController@pickup_point_order_sales_show')->name('pick_up_point.order_show');

    Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');

    Route::post('/pay_to_seller', 'CommissionController@pay_to_seller')->name('commissions.pay_to_seller');

    //Reports
    Route::get('/stock_report', 'ReportController@stock_report')->name('stock_report.index');
    Route::get('/in_house_sale_report', 'ReportController@in_house_sale_report')->name('in_house_sale_report.index');
    Route::get('/seller_sale_report', 'ReportController@seller_sale_report')->name('seller_sale_report.index');
    Route::get('/wish_report', 'ReportController@wish_report')->name('wish_report.index');
    Route::get('/user_search_report', 'ReportController@user_search_report')->name('user_search_report.index');
    Route::get('/wallet-history', 'ReportController@wallet_transaction_history')->name('wallet-history.index');

    Route::get('/main/report', [ReportController::class, "main_report"])->name('main.reports');
    Route::post('/main/report/sales', [ReportController::class, "main_report_sales"]);
    Route::post('/main/report/product_prices', [ReportController::class, "main_report_product_prices"]);
    Route::post('/main/report/main_report_taxes_cost_ect', [ReportController::class, "main_report_taxes_cost_ect"]);
    Route::post('/main/report/sales_products', [ReportController::class, "sales_products"]);
    Route::post('/main/report/all_brands_products_sale', [ReportController::class, "all_brands_products_sale"]);
    Route::post('/main/report/all_categories_products_sale', [ReportController::class, "all_categories_products_sale"]);
    Route::post('/main/report/sales_coupons_data', [ReportController::class, "sales_coupons_data"]);
    Route::get('/main/report/searches', [ReportController::class, "searches"]);





    Route::post('/main/report/products', [ReportController::class, "main_report_products"]);
    Route::post('/main/report/abandoned_baskets', [ReportController::class, "abandoned_baskets"]);


    Route::post('/main/report/customers', [ReportController::class, "main_report_customers"]);
    Route::post('/main/report/sellers', [ReportController::class, "main_report_sellers"]);
    Route::post('/main/report/orders', [ReportController::class, "main_report_orders"]);

    Route::post('/main/report/visits', [ReportController::class, "main_report_visits"]);




    //refurbished
    Route::get('/product_setting', 'ProductController@product_setting')->name('product.setting');
    Route::post('/create_degree', 'RefurbishedController@create_refurbished_degree')->name('refurbished.degree');
    Route::get('/delete_degree/{id}', 'RefurbishedController@delete_refurbished_degree');
    Route::get('/get_refurbished_degrees', 'RefurbishedController@get_refurbished_degrees');
    Route::post('/create_refurbished_product', 'RefurbishedController@create_refurbished_product');



    //Blog Section
    Route::resource('blog-category', 'BlogCategoryController');
    Route::get('/blog-category/destroy/{id}', 'BlogCategoryController@destroy')->name('blog-category.destroy');
    Route::resource('blog', 'BlogController');
    Route::get('/blog/destroy/{id}', 'BlogController@destroy')->name('blog.destroy');
    Route::post('/blog/change-status', 'BlogController@change_status')->name('blog.change-status');

    //Coupons
    Route::resource('coupon', 'CouponController');
    Route::post('/coupon/get_form', 'CouponController@get_coupon_form')->name('coupon.get_coupon_form');
    Route::post('/coupon/get_form_edit', 'CouponController@get_coupon_form_edit')->name('coupon.get_coupon_form_edit');
    Route::get('/coupon/destroy/{id}', 'CouponController@destroy')->name('coupon.destroy');
    Route::post('/coupon/serch/product', [CouponController::class, 'search_product'])->name("search.product.list");

    //Reviews
    Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
    Route::post('/reviews/published', 'ReviewController@updatePublished')->name('reviews.published');

    //Support_Ticket
    Route::get('support_ticket/', 'SupportTicketController@admin_index')->name('support_ticket.admin_index');
    Route::get('support_ticket/{id}/show', 'SupportTicketController@admin_show')->name('support_ticket.admin_show');
    Route::post('support_ticket/reply', 'SupportTicketController@admin_store')->name('support_ticket.admin_store');

    //Pickup_Points
    Route::resource('pick_up_points', 'PickupPointController');
    Route::get('/pick_up_points/edit/{id}', 'PickupPointController@edit')->name('pick_up_points.edit');
    Route::get('/pick_up_points/destroy/{id}', 'PickupPointController@destroy')->name('pick_up_points.destroy');

    //conversation of seller customer
    Route::get('conversations', 'ConversationController@admin_index')->name('conversations.admin_index');
    Route::get('conversations/{id}/show', 'ConversationController@admin_show')->name('conversations.admin_show');

    Route::post('/sellers/profile_modal', 'SellerController@profile_modal')->name('sellers.profile_modal');
    Route::post('/sellers/approved', 'SellerController@updateApproved')->name('sellers.approved');

    Route::resource('attributes', 'AttributeController');
    Route::get('/attributes/edit/{id}', 'AttributeController@edit')->name('attributes.edit');
    Route::get('/attributes/destroy/{id}', 'AttributeController@destroy')->name('attributes.destroy');

    Route::resource('attribute_values', 'AttributeValueController');
    Route::get('/attribute_values/edit/{id}', 'AttributeValueController@edit')->name('attribute_values.edit');
    Route::get('/attribute_values/destroy/{id}', 'AttributeValueController@destroy')->name('attribute_values.destroy');



    Route::resource('addons', 'AddonController');
    Route::post('/addons/upload_file_system', 'AddonController@upload_file_system')->name('update.system');

    Route::post('/addons/activation', 'AddonController@activation')->name('addons.activation');

    Route::get('/customer-bulk-upload/index', 'CustomerBulkUploadController@index')->name('customer_bulk_upload.index');
    Route::post('/bulk-user-upload', 'CustomerBulkUploadController@user_bulk_upload')->name('bulk_user_upload');
    Route::post('/bulk-customer-upload', 'CustomerBulkUploadController@customer_bulk_file')->name('bulk_customer_upload');
    Route::get('/user', 'CustomerBulkUploadController@pdf_download_user')->name('pdf.download_user');
    //Customer Package

    Route::resource('customer_packages', 'CustomerPackageController');
    Route::get('/customer_packages/edit/{id}', 'CustomerPackageController@edit')->name('customer_packages.edit');
    Route::get('/customer_packages/destroy/{id}', 'CustomerPackageController@destroy')->name('customer_packages.destroy');

    //Classified Products
    Route::get('/classified_products', 'CustomerProductController@customer_product_index')->name('classified_products');
    Route::post('/classified_products/published', 'CustomerProductController@updatePublished')->name('classified_products.published');

    //Shipping Configuration
    Route::get('/shipping_configuration', 'BusinessSettingsController@shipping_configuration')->name('shipping_configuration.index');
    Route::post('/shipping_configuration/update', 'BusinessSettingsController@shipping_configuration_update')->name('shipping_configuration.update');

    // Route::resource('pages', 'PageController');
    // Route::get('/pages/destroy/{id}', 'PageController@destroy')->name('pages.destroy');

    Route::resource('countries', 'CountryController');
    Route::post('/countries/status', 'CountryController@updateStatus')->name('countries.status');
    Route::get('all_countries', [CountryController::class, 'all_countries']);

    ////






    Route::resource('cities', 'CityController');
    Route::get('/cities/edit/{id}', 'CityController@edit')->name('admin.cities.edit');
    Route::get('/cities/destroy/{id}', 'CityController@destroy')->name('cities.destroy');
    Route::get('all_cities', [CityController::class, 'all_cities']);
    Route::get('/all_cities/export_cities', [CityController::class, 'export_cities'])->name('CitesExport');
    Route::get('/all_cities/governorate_pdf', [CityController::class, 'download_governorate'])->name('pdf.download_governorate');

    Route::post('/all_cities/import_city', [CityController::class, 'import_city'])->name('CitesImport');
    Route::get('/cities/governorates/{id}', 'CityController@get_governorates')->name('cities.governorates');
    // Route::get('/cities/governorates/pdf', [CityController::class, 'download_governorate'])->name('pdf.download_governorate');



    Route::view('/system/update', 'backend.system.update')->name('system_update');
    Route::view('/system/server-status', 'backend.system.server_status')->name('system_server');

    // uploaded files
    Route::any('/uploaded-files/file-info', 'AizUploadController@file_info')->name('uploaded-files.info');
    Route::resource('/uploaded-files', 'AizUploadController');
    Route::get('/uploaded-files/destroy/{id}', 'AizUploadController@destroy')->name('uploaded-files.destroy');


    // Abandoned baskets
    Route::get('abandoned/baskets', [AbandonedBasketsController::class, 'index'])->name("abandoned_baskets.index");
    Route::get('abandoned/carts', [AbandonedBasketsController::class, 'all_carts']);

    Route::get('abandoned/all_baskets', [AbandonedBasketsController::class, 'all_baskets']);

    Route::post('abandoned/user_products', [AbandonedBasketsController::class, 'user_products']);

    Route::post('abandoned/search_abandoned_baskets', [AbandonedBasketsController::class, 'search_abandoned_baskets']);
    Route::get('/customer/login_complete_order/{id}', [CustomerController::class, 'login_complete_order']);
    Route::get('/abandoned/baskets/profile', [AbandonedBasketsController::class, 'index']);

    Route::get('/customer/customerData/{id}', [CustomerController::class, 'customerData']);
    Route::post('/abandoned/products_user', [AbandonedBasketsController::class, 'products_user']);




    Route::any('nav/search', [HomeController::class, 'search_navbar'])->name("search.navbar");

    // Route::any('nav/search', [HomeController::class, 'search_navbar'])->name("search.navbar");

    Route::post('/user/getUser', [HomeController::class, 'getUser']);

    Route::post('/users/getUsers', [HomeController::class, 'getUsers']);

    Route::post('/user/setDataUser', [HomeController::class, 'setDataUser']);
    Route::post('/user/setAvatarUser', [HomeController::class, 'setAvatarUser']);
    Route::get('orders_count', [HomeController::class, 'orders_count']);
    Route::get('total_categories', [HomeController::class, 'total_categories']);
    Route::get('total_brends', [HomeController::class, 'total_brends']);
    Route::get('total_products_published', [HomeController::class, 'total_products_published']);
    Route::get('total_products_sellers', [HomeController::class, 'total_products_sellers']);
    Route::get('total_products_admins', [HomeController::class, 'total_products_admins']);

    Route::get('total_sellers', [HomeController::class, 'total_sellers']);
    Route::get('total_approved_sellers', [HomeController::class, 'total_approved_sellers']);
    Route::get('total_pendding_sellers', [HomeController::class, 'total_pendding_sellers']);
    Route::get('number_of_sales', [HomeController::class, 'number_of_sales']);
    Route::get('number_of_stock_products', [HomeController::class, 'number_of_stock_products']);
    Route::get('get_top_products', [HomeController::class, 'get_top_products']);



    //ceckouts
    Route::post('/checkout/createCeckoutOrder', [CheckoutController::class, 'createCeckoutOrder']);


    //payment
    Route::get('/tappayment/view_card_page', [TabpaymentController::class, 'view_card_page'])->name("new_order.view_tappayment");
    Route::get('/paytab/pay', [PayTabController::class, 'pay'])->name("new_order.paytab.pay");


    //special offers
    Route::get('/special/offers', [SpecialOfferController::class, 'index'])->name("special_offers.index");
    Route::post('/special/storeXtoY', [SpecialOfferController::class, 'storeXtoY']);
    Route::post('/special/customerFixedPurches', [SpecialOfferController::class, 'customerFixedPurches']);
    Route::post('/special/customerPercentPurches', [SpecialOfferController::class, 'customerPercentPurches']);
    Route::get('/special/getSpecialOffers', [SpecialOfferController::class, 'getSpecialOffers']);
    Route::get('/sapecialOffers/new_spcial_offers', [SpecialOfferController::class, 'new_spcial_offers']);
    Route::get('/spcialOffer/destroy/{id}', [SpecialOfferController::class, 'spcial_offer_destroy']);

    //prices system
    Route::get('/price_system/all_curruncies', [PriceSystem::class, 'all_curruncies']);




    //firebase
    Route::get('/firebase/index', [FirebasController::class, 'index'])->name("firebase.index");


    //sms settings
    Route::get('/smsSetting', [BusinessSettingsController::class, 'sms_setting_index'])->name("sms_settings.index");
    Route::post('/send_sms', [BusinessSettingsController::class, 'send_sms']);


    //orders logs
    Route::get('/ordersLog/index', [OrdersLogController::class, 'index'])->name("ordersLog.index");
    Route::post('/ordersLog/data', [OrdersLogController::class, 'orders_data']);



    //refunds requests
    Route::get('/refundRequest/index', [RefundRequestController::class, 'index'])->name("refund_request.index");
    Route::post('/refundRequest/data', [RefundRequestController::class, 'refund_requests_data']);
    Route::post('/refundRequest/cancel', [RefundRequestController::class, 'refund_requests_cancel']);



    // reminder basket

    Route::post('/reminder_basket/saveDataReminder', [ReminderBasketController::class, 'saveDataReminder']);
    Route::post('/reminder_basket/saveDataReminderPublic', [ReminderBasketController::class, 'saveDataReminderPublic']);

    Route::get('/reminder_basket/reminders', [ReminderBasketController::class, 'reminders']);
});
