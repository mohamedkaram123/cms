<?php

namespace App\Exports;

use App\Language;
use App\Translation;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitiesExport implements FromCollection, WithMapping, WithHeadings
{




    function __construct()
    {
    }


    public function collection()
    {
        return new Collection();
    }

    public function headings(): array
    {
        return [
            'governorate_id',
            'name',
            'cost',
            'shipping_days'

        ];
    }

    /**
     * @var Product $product
     */
    public function map($trans): array
    {
        return [];
    }
}
