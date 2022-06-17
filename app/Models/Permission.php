<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = "permissions";

    protected $fillable = ["role_id", "title", "permission_link"];

    protected $appends = ["roles"];

    /**
     * Get the role t Permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function  getRolesAttribute()
    {
        return $this->role->name;
    }

    public function  getCreatedAtAttribute()
    {
        return substr($this->attributes['created_at'], 0, 10);
    }
}
