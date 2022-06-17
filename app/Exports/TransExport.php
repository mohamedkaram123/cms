<?php

namespace App\Exports;

use App\Language;
use App\Translation;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransExport implements FromCollection, WithMapping, WithHeadings
{



    protected $lang;

    function __construct($lang)
    {
        $this->lang = $lang;
    }


    public function collection()
    {

        $data_lang = [];
        $endatas = Translation::where("lang", "en")->get();
        foreach ($endatas as $item) {
            if (empty(Translation::where("lang_key", $item->lang_key)->where("lang", "sa")->first())) {
                $data_lang[] = $item;
            }
        }

        return new Collection($data_lang);
    }

    public function headings(): array
    {
        return [
            'lang',
            'lang_key',
            'lang_value',

        ];
    }

    /**
     * @var Product $product
     */
    public function map($trans): array
    {
        return [
            $this->lang,
            // $trans->lang_key,
            $trans->lang_key,
            "",
            //  $trans->lang_value,

        ];
    }
}
