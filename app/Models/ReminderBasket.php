<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReminderBasket extends Model
{
    use HasFactory;

    protected $table = "reminder_baskets";

    /**
     * Get all of the reminderCustomers for the ReminderBasket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reminderCustomers()
    {
        return $this->hasMany(ReminderCustomer::class, 'reminder_id');
    }



    /**
     * Get the user associated with the ReminderBasket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function discount()
    {
        return $this->hasOne(TemporaryDiscount::class, 'reminder_id');
    }
}
