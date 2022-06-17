<?php
namespace App\MyClasses;

use App\Models\Activity;
use Auth;

class History{


     static function Modules()
    {

        return [
            "1"=>[
                "title"=>translate("Vistores"),
                "disc"=>translate("module has all things about vistores")
            ]
            ];
    }


     static function Cat()
    {

        return [
            "1"=>[
                "module_id"=>"1",
                "title"=>translate("Vistores"),
                "disc"=>translate("categorey content all thing about vistores from create and edit and updates"),

            ]
            ];
    }



     static function Operations()
    {
        return [
            "1" => [
                "title" => translate('View'),
                "icon" => "fe fe-eye",
            ],
            "2" => [
                "title" => translate('Add'),
                "icon" => "fe fe-plus-circle text-success",
            ],
            "3" => [
                "title" => translate('Edit'),
                "icon" => "fe fe-edit text-info",
            ],
            "4" => [
                "title" => translate('Delete'),
                "icon" => "fe fe-trash text-danger",
            ],
            "5" => [
                "title" => translate('Print'),
                "icon" => "fe fe-printer text-warning",
            ],
            "6" => [
                "title" => translate('Send'),
                "icon" => "fe fe-send text-success",
            ],
            "7" => [
                "title" => translate('Download'),
                "icon" => "fe fe-download",
            ],
            "8" => [
                "title" => translate('Pan'),
                "icon" => "fe fe-delete text-danger",
            ],
            "9" => [
                "title" => translate('Active'),
                "icon" => "fe fe-check-circle",
            ],
            "10" => [
                "title" => translate('Export'),
                "icon" => "fe fe-arrow-down-circle",
            ],
            "11" => [
                "title" => translate('Import'),
                "icon" => "fe fe-arrow-up-circle",
            ],
            "12" => [
                "title" => translate('Backup'),
                "icon" => "fe fe-database",
            ],
            "13" => [
                "title" => translate('Restore'),
                "icon" => "fe fe-clock",
            ],
            "14" => [
                "title" => translate('Share'),
                "icon" => "fe fe-share",
            ]
        ];

    }

    static function Log($module = 0, $cat = 0, $record_id = 0, $operation = 0, $title = "")
    {
        $Log = new Activity();
        $Log->log_id= $module . $cat . $record_id . $operation;

        $Log->module = $module;
        $Log->cat = $cat;
        $Log->record_id = $record_id;
        $Log->operation = $operation;
        $Log->title_key = $title;
        $Log->user_type = auth()->check()?auth()->user()->user_type:"guest";
        $Log->created_ip = \Request::ip();
        $Log->created_by = auth()->check()?auth()->user()->id:null;
        $Log->save();
    }
}
