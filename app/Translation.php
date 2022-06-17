<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
  //
     /**
     * The attributes that are mass assignable.
     *
     *@var array
     */
    protected $fillable = [
        'lang',
        'lang_key',
        'lang_value',
    ];

}
