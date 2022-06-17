<?php

namespace App\MyClasses;

use Auth;

class Roles
{
    static function List()
    {
        return [
            [
                "group_title" => translate('Products Roles'),
                "group_role" => "1",
                "group_roles" => [
                    [
                        "role" => "2",
                        "title" => translate('Add Product'),
                    ],
                    [
                        "role" => "3",
                        "title" => translate('Show All Products'),
                    ],
                    [
                        "role" => "4",
                        "title" => translate('Home Products'),
                    ],
                    [
                        "role" => "5",
                        "title" => translate('Return Product'),
                    ],
                    [
                        "role" => "10",
                        "title" => translate('Comments Product'),
                    ],
                    [
                        "role" => "11",
                        "title" => translate('Import Product'),
                    ],
                    [
                        "role" => "12",
                        "title" => translate('Export Product'),
                    ],
                    [
                        "role" => "13",
                        "title" => translate('Product Review'),
                    ],
                    [
                        "role" => "14",
                        "title" => translate('Product Archive'),
                    ],
                    [
                        "role" => "15",
                        "title" => translate('Edit Product'),
                    ],
                    [
                        "role" => "16",
                        "title" => translate('Remove Product'),
                    ],
                    [
                        "role" => "17",
                        "title" => translate('Copy Product'),
                    ],
                    [
                        "role" => "18",
                        "title" => translate('Published Product'),
                    ],
                    [
                        "role" => "19",
                        "title" => translate('Featured Product'),
                    ],
                    [
                        "role" => "20",
                        "title" => translate('Exclusive To Website'),
                    ],
                ],
            ],
            [
                "group_title" => translate('Digital Products Roles'),
                "group_role" => "240",
                "group_roles" => [
                    [
                        "role" => "247",
                        "title" => translate('show Digital Product'),
                    ],
                    [
                        "role" => "241",
                        "title" => translate('Create Digital Product'),
                    ],
                    [
                        "role" => "242",
                        "title" => translate('Edit Digital Product'),
                    ],
                    [
                        "role" => "243",
                        "title" => translate('remove Digital Product'),
                    ],
                    [
                        "role" => "244",
                        "title" => translate('Download Digital Product'),
                    ],
                    [
                        "role" => "245",
                        "title" => translate('Published Digital Product'),
                    ],
                    [
                        "role" => "246",
                        "title" => translate('Features Digital Product'),
                    ],

                ],
            ],
            [
                "group_title" => translate('Category Roles'),
                "group_role" => "260",
                "group_roles" => [
                    [
                        "role" => "261",
                        "title" => translate('show Category Product'),
                    ],
                    [
                        "role" => "262",
                        "title" => translate('Create Category Product'),
                    ],
                    [
                        "role" => "263",
                        "title" => translate('Edit Category Product'),
                    ],
                    [
                        "role" => "264",
                        "title" => translate('remove Category Product'),
                    ],
                    [
                        "role" => "265",
                        "title" => translate('feature Category Product'),
                    ],
                ],
            ],
            [
                "group_title" => translate('Brand Roles'),
                "group_role" => "280",
                "group_roles" => [
                    [
                        "role" => "281",
                        "title" => translate('show Brand Product'),
                    ],
                    [
                        "role" => "282",
                        "title" => translate('Create Brand Product'),
                    ],
                    [
                        "role" => "283",
                        "title" => translate('Edit Brand Product'),
                    ],
                    [
                        "role" => "284",
                        "title" => translate('remove Brand Product'),
                    ]
                ],
            ],
            [
                "group_title" => translate('Variant Product Roles'),
                "group_role" => "300",
                "group_roles" => [
                    [
                        "role" => "301",
                        "title" => translate('show Variant Product'),
                    ],
                    [
                        "role" => "302",
                        "title" => translate('Create Variant Product'),
                    ],
                    [
                        "role" => "303",
                        "title" => translate('Edit Variant Product'),
                    ],
                    [
                        "role" => "304",
                        "title" => translate('remove Variant Product'),
                    ]
                ],
            ],
            [
                "group_title" => translate('Sales Roles'),
                "group_role" => "31",
                "group_roles" => [
                    [
                        "role" => "21",
                        "title" => translate('Show All Sales'),
                    ],
                    [
                        "role" => "22",
                        "title" => translate('Commands Home'),
                    ],
                    [
                        "role" => "23",
                        "title" => translate('Sales Seller'),
                    ],
                    [
                        "role" => "24",
                        "title" => translate('Sales Log'),
                    ],
                    [
                        "role" => "25",
                        "title" => translate('Sales Refunds Request'),
                    ],
                    [
                        "role" => "26",
                        "title" => translate('Edit Order'),
                    ],
                    [
                        "role" => "27",
                        "title" => translate('Show Order'),
                    ],
                    [
                        "role" => "28",
                        "title" => translate('Download Order'),
                    ],
                    [
                        "role" => "29",
                        "title" => translate('Remove Order'),
                    ],
                    [
                        "role" => "30",
                        "title" => translate('Refund Order'),
                    ],
                ],
            ],
            [
                "group_title" => translate('Customers Roles'),
                "group_role" => "40",
                "group_roles" => [
                    [
                        "role" => "41",
                        "title" => translate('Show All Customers'),
                    ],
                    [
                        "role" => "42",
                        "title" => translate('List Customers'),
                    ],
                    [
                        "role" => "43",
                        "title" => translate('Arranges Product'),
                    ],
                    [
                        "role" => "44",
                        "title" => translate('Package Customers'),
                    ],
                    [
                        "role" => "45",
                        "title" => translate('Show Customers'),
                    ],
                    [
                        "role" => "46",
                        "title" => translate('Edit Customers'),
                    ],
                    [
                        "role" => "47",
                        "title" => translate('Remove Customers'),
                    ],
                    [
                        "role" => "48",
                        "title" => translate('Ban Customers'),
                    ],
                ],
            ],
            // [
            //     "group_title" => translate('Sellers Roles'),
            //     "group_role" => "60",
            //     "group_roles" => [
            //         [
            //             "role" => "61",
            //             "title" => translate('Show All Sellers'),
            //         ],
            //         [
            //             "role" => "62",
            //             "title" => translate('Show All Sellers js'),
            //         ],
            //         [
            //             "role" => "63",
            //             "title" => translate('Seller Payments'),
            //         ],
            //         [
            //             "role" => "64",
            //             "title" => translate('withdraw All Requests'),
            //         ],
            //         [
            //             "role" => "65",
            //             "title" => translate('Seller Comissions'),
            //         ],
            //         [
            //             "role" => "66",
            //             "title" => translate('Seller Verfication'),
            //         ],

            //     ],
            // ],
            [
                "group_title" => translate('Uploaded Files'),
                "group_role" => "80",
                "group_roles" => [],
            ],
            [
                "group_title" => translate('Reports Roles'),
                "group_role" => "100",
                "group_roles" => [
                    [
                        "role" => "101",
                        "title" => translate('Main Report'),
                    ],
                    [
                        "role" => "102",
                        "title" => translate('Home Products Report'),
                    ],
                    [
                        "role" => "103",
                        "title" => translate('Seller Products Report'),
                    ],
                    [
                        "role" => "104",
                        "title" => translate('Stocks Products'),
                    ],
                    [
                        "role" => "105",
                        "title" => translate('Favorite Products List'),
                    ],
                    [
                        "role" => "106",
                        "title" => translate('User searches'),
                    ],
                    [
                        "role" => "107",
                        "title" => translate('Commission History'),
                    ],
                    [
                        "role" => "108",
                        "title" => translate('Wallet Recharge History'),
                    ],
                ],
            ],
            [
                "group_title" => translate('Posts System Roles'),
                "group_role" => "120",
                "group_roles" => [
                    [
                        "role" => "121",
                        "title" => translate('Show All Posts'),
                    ],
                    [
                        "role" => "122",
                        "title" => translate('Posts Categories'),
                    ]
                ],
            ],
            [
                "group_title" => translate('Marketing Roles'),
                "group_role" => "140",
                "group_roles" => [

                    [
                        "role" => "142",
                        "title" => translate('News Letters'),
                    ],
                    [
                        "role" => "143",
                        "title" => translate('Participants'),
                    ],
                    [
                        "role" => "144",
                        "title" => translate('Coupons'),
                    ],
                    [
                        "role" => "145",
                        "title" => translate('Abandoned Baskets'),
                    ],
                    [
                        "role" => "146",
                        "title" => translate('Special Offers'),
                    ],
                ],
            ],
            [
                "group_title" => translate('Support Roles'),
                "group_role" => "160",
                "group_roles" => [
                    [
                        "role" => "161",
                        "title" => translate('Ticket'),
                    ],
                    [
                        "role" => "162",
                        "title" => translate('Inquiry Product'),
                    ],
                ],
            ],
            [
                "group_title" => translate('Settings Website Roles'),
                "group_role" => "180",
                "group_roles" => [
                    [
                        "role" => "181",
                        "title" => translate('Header'),
                    ],
                    [
                        "role" => "182",
                        "title" => translate('Footer'),
                    ],
                    [
                        "role" => "183",
                        "title" => translate('Pages'),
                    ],
                    [
                        "role" => "184",
                        "title" => translate('appearance'),
                    ],
                ],
            ],
            [
                "group_title" => translate('Settings and Configurations Roles'),
                "group_role" => "200",
                "group_roles" => [
                    [
                        "role" => "201",
                        "title" => translate('General settings'),
                    ],
                    [
                        "role" => "202",
                        "title" => translate('Activate features'),
                    ],
                    [
                        "role" => "203",
                        "title" => translate('Languages'),
                    ],
                    [
                        "role" => "204",
                        "title" => translate('Currency'),
                    ],
                    [
                        "role" => "205",
                        "title" => translate('Tax'),
                    ],
                    [
                        "role" => "206",
                        "title" => translate('Smtp Settings'),
                    ],
                    [
                        "role" => "207",
                        "title" => translate('Sms Settings'),
                    ],
                    [
                        "role" => "208",
                        "title" => translate('Firebase Settings'),
                    ],
                    [
                        "role" => "209",
                        "title" => translate('Payment Methods'),
                    ],
                    [
                        "role" => "210",
                        "title" => translate('Configurations File System'),
                    ],
                    [
                        "role" => "211",
                        "title" => translate('Login Social Media'),
                    ],
                    [
                        "role" => "212",
                        "title" => translate('Analytics Tools'),
                    ],
                    [
                        "role" => "213",
                        "title" => translate('Login Social Media Facebook'),
                    ],
                    [
                        "role" => "214",
                        "title" => translate('Google Recapther'),
                    ],
                    [
                        "role" => "215",
                        "title" => translate('Shipping'),
                    ],
                    [
                        "role" => "216",
                        "title" => translate('Pusher'),
                    ],
                    [
                        "role" => "217",
                        "title" => translate('Order Setting'),
                    ],
                ],
            ],

            [
                "group_title" => translate('Staffs'),
                "group_role" => "220",
                "group_roles" => [
                    [
                        "role" => "221",
                        "title" => translate('All Staffs'),
                    ],
                    [
                        "role" => "222",
                        "title" => translate('Staff permissions'),
                    ],
                ],
            ],
            [
                "group_title" => translate('Flash Deals'),
                "group_role" => "320",
                "group_roles" => [
                    [
                        "role" => "321",
                        "title" => translate('All Flash Deals'),
                    ],
                    [
                        "role" => "322",
                        "title" => translate('Create Flash Deals'),
                    ],
                    [
                        "role" => "323",
                        "title" => translate('Edit Flash Deals'),
                    ],
                    [
                        "role" => "324",
                        "title" => translate('Remove Flash Deals'),
                    ],
                    [
                        "role" => "325",
                        "title" => translate('Status Flash Deals'),
                    ],
                    [
                        "role" => "326",
                        "title" => translate('Features Flash Deals'),
                    ],
                ],
            ],
            [
                "group_title" => translate('Prevent Open Website'),
                "group_role" => "340",
                "group_roles" => [
                    [
                        "role" => "341",
                        "title" => translate('show web site'),
                    ]
                ],
            ],

        ];
    }

    static function Check($num)
    {


        try {
            $check = false;
            if (Auth::user()->user_type == 'admin' || in_array($num, json_decode(Auth::user()->staff->role->permissions))) {
                $check = true;
            }

            return $check;
        } catch (\Throwable $th) {
            return redirect()->route("login");
        }
    }


    static function CheckRoleReact($nums)
    {
        $checks = [];
        foreach ($nums as $num) {
            $checks[$num] = false;
            if (Auth::user()->user_type == 'admin' || in_array($num, json_decode(Auth::user()->staff->role->permissions))) {
                $checks[$num] = true;
            }
        }

        return $checks;
    }
}
