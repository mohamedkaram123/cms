<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReminderCustomer extends Model
{
    use HasFactory;

    protected $table = "reminder_customers";


    /**
     * Get the user that owns the ReminderCustomer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that owns the ReminderCustomer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reminder()
    {
        return $this->belongsTo(ReminderBasket::class, 'reminder_id');
    }
}
