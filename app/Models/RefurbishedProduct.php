<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefurbishedProduct extends Model
{
    use HasFactory;

    protected $table = "refurbished_products";

    /**
     * Get the degree that owns the RefurbishedProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function degree()
    {
        return $this->belongsTo(RefurbishedDegree::class, 'refurbished_degree_id');
    }
}
