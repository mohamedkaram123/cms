<?php

namespace App\MyClasses;

use App\Models\Search as ModelsSearch;
use App\Models\SearchType;
use App\Upload;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Search
{

    public static function set_data_Search($products, $categories, $keywords, $shops, $query)
    {

        $search = new self;
        $search->search_products($products, $query);
        $search->search_categories($categories, $query);
        $search->search_shops($shops, $query);
        $search->search_keywords($keywords, $query);
    }
    public function search_products($products, $query)
    {
        if (sizeof($products) > 0) {
            foreach ($products as $item) {
                $this->set_search_result("products", $item, $query);
            }
        }
    }
    public function search_categories($categories, $query)
    {
        if (sizeof($categories) > 0) {
            foreach ($categories as $item) {
                $this->set_search_result("categories", $item, $query);
            }
        }
    }

    public function search_shops($shops, $query)
    {
        if (sizeof($shops) > 0) {
            foreach ($shops as $item) {
                $this->set_search_result("shops", $item, $query);
            }
        }
    }

    public function search_keywords($keywords, $query)
    {
        if (sizeof($keywords) > 0) {
            foreach ($keywords as $item) {
                $this->set_search_result("keywords", $item, $query);
            }
        }
    }
    public function object_type($type)
    {
        $search_type = SearchType::where("type", $type)->first();
        if (!empty($search_type)) {
            return $search_type;
        }
        return null;
    }
    public function set_search_result($type, $object, $query)
    {
        if ($query != null) {
            $obj_type = $this->object_type($type);
            $user_id = auth()->check() ? auth()->user()->id : null;
            $search = ModelsSearch::where("object_type_id", $obj_type->id)->where("object_id", $object->id)->where("query", "like", "%$query%")->first();
            if (!empty($search)) {
                $search->count = $search->count + 1;
                $search->save();
            } else {
                $new_search = new ModelsSearch();
                $new_search->query = $query;
                $new_search->object_type_id = $obj_type->id;
                $new_search->object_id = $object->id;
                $new_search->user_id = $user_id;
                $new_search->save();
            }
        }
    }

    public function get_public_search()
    {
        $searchs = ModelsSearch::limit(100)->orderBy('count', 'desc')->get();
        return $searchs;
    }

    public function popular_searches()
    {
        $searches = $this->get_public_search();
        return $this->queries_form_sessions($searches);
    }

    public function get_user_search()
    {
        if (auth()->check()) {
            $searches = $this->get_auth_search();
            return $this->queries_form_sessions($searches);
        } else {
            return $this->get_session_search();
        }
    }

    public function get_auth_search()
    {
        $user_id = auth()->user()->id;

        $searchs = ModelsSearch::where("user_id", $user_id)->limit(100)->orderBy('id', 'desc')->get();
        return $searchs;
    }

    public function queries_form_sessions($searchs)
    {
        $queries = [];

        foreach ($searchs as $item) {
            $queries[] = $item->query;
        }
        return $queries;
    }

    public function set_session_search($query)
    {
        if ($query != null) {
            $queries = Session::get("query_search");
            $queries[] = $query;
            Session::put("query_search", $queries);
        }
    }
    public function set_user_search($query)
    {
        if ($query != null) {
            $user_search = new ModelsSearch();
            $user_search->query = $query;
            $user_search->user_id = auth()->user()->id;
            $user_search->object_id = auth()->user()->id;
            $user_search->object_type_id = 3;
            $user_search->save();
        }
    }

    public function set_search($query)
    {
        if (auth()->check()) {
            $this->set_user_search($query);
        } else {
            $this->set_session_search($query);
        }
    }


    public function get_session_search()
    {
        $queries = Session::get("query_search");
        return array_reverse(is_array($queries) ? $queries : []);
    }
    public static function get_top_10_products_search()
    {
        $products = DB::table('searches')
            ->join('products', function ($join) {
                $join->on('products.id', '=', 'searches.object_id');
            })
            ->where("searches.object_type_id", 1)
            ->select("products.photos", "products.id", "products.name", "products.slug", "searches.count", "searches.query")
            ->limit(10)
            ->get();
        $products = $products->map(function ($item) {
            $item->name = !empty(getTranslation($item->id)) ? getTranslation($item->id) : $item->name;
            $item->photo = photo($item->photos);
            return $item;
        });

        return $products;
    }

    public static function get_top_10_categories_search()
    {
        $categories = DB::table('searches')
            ->join('categories', function ($join) {
                $join->on('categories.id', '=', 'searches.object_id');
            })
            ->where("searches.object_type_id", 2)
            ->select("categories.icon", "categories.id", "categories.name", "categories.slug", "searches.count", "searches.query")
            ->limit(10)
            ->get();
        $categories = $categories->map(function ($item) {
            $item->name = !empty(getTranslation_cat($item->id)) ? getTranslation_cat($item->id) : $item->name;
            $item->icon = photo($item->icon);
            return $item;
        });

        return $categories;
    }
}
