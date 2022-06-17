<?php

namespace App\Imports;

use App\Product;
use App\Translation;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Auth;

class TransImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {

       $trans =  Translation::where("lang",$row['lang'])->where("lang_key",$row['lang_key'])->first();

        if(!empty($trans)){
            $trans->lang_value =  $row['lang_value'];
            $trans->save();
            return $trans;
        }else{
            return new Translation([
                'lang' => $row['lang'],
                'lang_key' => $row['lang_key'],
                'lang_value' => $row['lang_value']
     
             ]);
        }
    
    }

    public function rules(): array
    {
        return [
             // Can also use callback validation rules
            //  'lang_key' => function($attribute, $value, $onFailure) {
                 

            //       if (!is_numeric($value)) {
            //            $onFailure('Unit price is not numeric');
            //       }
            //   }
        ];
    }

   
}
