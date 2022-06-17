<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Laravel\Passport\HasApiTokens;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Cart;
use App\Models\Country;
use App\Models\ReminderCustomer;
use App\Models\TemporaryDiscountUsage;
use App\Notifications\EmailVerificationNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification($this->name));
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'city', 'postal_code',
        'phone',  'provider_id', 'email_verified_at', 'verification_code',
        'user_type', 'otp', 'country_id', 'show_msg_add_cart'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'country'
    ];

    // protected $appends = ['temp_discount'];


    // public function getTempDiscountAttribute()
    // {

    //     $reminderCustomer =   $this->reminderCustomer;
    //     if (count($reminderCustomer) != 0) {
    //         $end_customer = $reminderCustomer[count($reminderCustomer) - 1];
    //         $reminder = $end_customer->reminder;
    //         $discount = $reminder->discount;

    //         if ($discount->expire_discount_date > now()) {
    //             $usage_user_count =   TemporaryDiscountUsage::where("user_id", auth()->user()->id)->where("temporary_discount_id", $discount->id)->get()->count();
    //             $total_usage_users_count = TemporaryDiscountUsage::where("temporary_discount_id", $discount->id)->get()->count();
    //             $total_usage_for_all = $discount->total_usage_for_all;
    //             $total_usage_for_one_user = $discount->total_usage_for_one_user;

    //             if ($total_usage_users_count <  $total_usage_for_all && $usage_user_count < $total_usage_for_one_user) {
    //                 return ["discount_type" => $discount->discount_type, "discount" => $discount->discount, "discount_id"=>$discount->id];
    //             }
    //         }
    //     }

    //     return null;
    // }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function affiliate_user()
    {
        return $this->hasOne(AffiliateUser::class);
    }

    public function affiliate_withdraw_request()
    {
        return $this->hasMany(AffiliateWithdrawRequest::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class)->orderBy('created_at', 'desc');
    }

    public function club_point()
    {
        return $this->hasOne(ClubPoint::class);
    }

    public function customer_package()
    {
        return $this->belongsTo(CustomerPackage::class);
    }

    public function customer_package_payments()
    {
        return $this->hasMany(CustomerPackagePayment::class);
    }

    public function customer_products()
    {
        return $this->hasMany(CustomerProduct::class);
    }

    public function seller_package_payments()
    {
        return $this->hasMany(SellerPackagePayment::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function ownerCarts()
    {
        return $this->hasMany(Cart::class, "owner_id");
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function affiliate_log()
    {
        return $this->hasMany(AffiliateLog::class);
    }

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function reminderCustomer()
    {
        return $this->hasMany(ReminderCustomer::class, 'user_id');
    }

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country_data()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
