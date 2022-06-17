<?php

namespace App\MyClasses;


class BusinessSettings
{

    public static function get_link($label, $key)
    {
        $link =  json_decode(get_setting('header_menu_links'), true)[$key];

        if ($label == "Home") {
            $link = url("/") . "/home";
        } else if ($label == "Flash Sale") {
            $link = url("/") . "/flash-deals";
        } else if ($label == "All Blogs") {
            $link = url("/") . "/blog";
        } else if ($label == "Back To School") {
            $link = url("/") . "/back_to_school";
        } else if ($label == "Exclusive To Web") {
            $link = url("/") . "/exclusive";
        } else if ($label == "Refurbished Products") {
            $link = url("/") . "/refurbished_products";
        }

        return $link;
    }

    public static function disabledHeaderLinksEdit($label)
    {
        $disabled = "";
        if ($label == "Home" || $label == "Flash Sale" || $label == "All Blogs") {
            $disabled = "readOnly";
        };

        return $disabled;
    }
}
