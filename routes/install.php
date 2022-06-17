<?php
/*
|--------------------------------------------------------------------------
| Install Routes
|--------------------------------------------------------------------------
|
| This route is responsible for handling the intallation process
|
|
|
*/

use Carbon\Carbon;


Route::get('purchase_code', 'InstallController@purchase_code')->name('purchase.code');
Route::post('purchase_system', 'InstallController@purchase_system')->name('purchase.system');

Route::group(['middleware' => ['PurchaseSystem']], function () {

    Route::get('/', 'InstallController@step0');
    Route::get('/step1', 'InstallController@step1')->name('step1');
    Route::get('/step2', 'InstallController@step2')->name('step2');
    Route::get('/step3/{error?}', 'InstallController@step3')->name('step3');
    Route::get('/step4', 'InstallController@step4')->name('step4');
    Route::get('/step5', 'InstallController@step5')->name('step5');

    Route::post('/database_installation', 'InstallController@database_installation')->name('install.db');
    Route::post('import_sql', 'InstallController@import_sql')->name('import_sql');
    Route::post('system_settings', 'InstallController@system_settings')->name('system_settings');
    //   Route::post('purchase_code', 'InstallController@purchase_code')->name('purchase.code');
});


Route::get('test3', function (Request $request) {

    $code = env("PURCHASE_ID_CODE");
    $sekret_key = env("PURCHASE_ID_CODE_SEKRET_KEY");

    $code = explode("-", $code);

    $start_date = new Carbon(date('Y-m-d', $code[0]));
    $sekret_key_purchase = $code[1];
    $number_of_monthes = $code[2];

    $check_purchase_code = true;

    //date_diff((new Carbon(date('Y-m-d', $start_date))), now());
    $differ_monthes =   $start_date->diffInMonths(now());

    if ($differ_monthes >= $number_of_monthes) {
        $check_purchase_code = false;
    }


    $keys = explode("_", $sekret_key);
    $keys = strtoupper($keys[0][0] . $keys[1][0] . $keys[2][0]);

    if ($keys !== $sekret_key_purchase) {
        $check_purchase_code = false;
    }

    //    $time = strtotime(now()->addMonths()); //  strtotime("1619913600");
    //date('d-m-Y', $coupon->end_date);
    return dd($check_purchase_code);
});
