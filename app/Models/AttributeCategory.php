<?php

namespace App\Models;

use App\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeCategory extends Model
{
    use HasFactory;

    protected $table = "attribute_categories";

    /**
     * Get the user that owns the AttributeCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attr()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
