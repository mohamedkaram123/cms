<?php

namespace App\MyClasses;

use Illuminate\Support\Facades\Config;
use Illuminate\Encryption\Encrypter;
use Carbon\Carbon;

class EncryptSystem
{

    public  $codeKey;
    public  $sekret_key;
    public $newEncrypter;


    function __construct($code_key = null)
    {

        $this->codeKey = !empty($code_key) ? $this->Purchase_Id_Code_Encrypt($code_key) : env("PURCHASE_ID_CODE");
        $this->sekret_key = env("PURCHASE_ID_CODE_SEKRET_KEY");
        $this->newEncrypter = new Encrypter($this->sekret_key, Config::get('app.cipher'));
    }

    public function Purchase_Id_Code_Encrypt($code)
    {
        $newEncrypter = new Encrypter(env("PURCHASE_ID_CODE_SEKRET_KEY"), Config::get('app.cipher'));

        $encrypted = $newEncrypter->encrypt($code);

        return $encrypted;
    }

    public function Purchase_Id_Code_Decrypt($encrypt_code)
    {
        $newEncrypter = new Encrypter(env("PURCHASE_ID_CODE_SEKRET_KEY"), Config::get('app.cipher'));
        $decrypted = $newEncrypter->decrypt($encrypt_code);

        return $decrypted;
    }
    public function Check_Date_Purchase_Id_Code_Decrypt()
    {

        if ($this->codeKey != "" && !empty($this->codeKey) && $this->sekret_key != "" && !empty($this->sekret_key)) {
            try {

                $code =  $this->Purchase_Id_Code_Decrypt($this->codeKey);


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



                $one_char =  substr($this->sekret_key, 0, 1);
                $two_char =  substr($this->sekret_key, 10, 1);
                $three_char =  substr($this->sekret_key, 20, 1);
                $keys = strtoupper($one_char . $two_char . $three_char);

                if ($keys !== $sekret_key_purchase) {
                    $check_purchase_code = false;
                }

                return $check_purchase_code;
            } catch (\Throwable $th) {
                //throw $th;
                return false;
            }
        }

        return false;
    }
}
