<?php

namespace App\MyClasses;

use App\Page;

class Pages
{

    public static function update_page_name($name, $type)
    {
        $page =  Page::where("type", $type)->first();
        if (!empty($page)) {
            $page->title = $name;
            $page->save();
        }

        return $page;
    }
}
