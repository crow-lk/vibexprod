<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Members extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'members';
    protected $fillable = ['membership_id','name','nic','email','phone','address','membership_status','subscription_id'];

    // public function membershipSubscriptions()
    // {
    //     return $this->hasMany(MembershipSubscriptions::class);
    // }

    protected static function booted()
    {
        static::created(function ($member) {
            // Create a default membership subscription when a new member is created
            MembershipSubscriptions::create([
                'member_id' => $member->id,
                'subscription_id' => 2, // Set to null or 'No Subscription Assigned'
                'start_date' => now(),
                'end_date' => now()->addMonth(), // Set to one month later (or as needed)
                'amount' => 0, // Set default amount
                'payment_status' => 'pending',
            ]);
        });
    }

    public function membershipSubscriptions()
    {
        return $this->hasMany(MembershipSubscriptions::class, 'member_id');
    }

    public function subscriptionPayments()
    {
        return $this->hasManyThrough(
            SubscriptionPayments::class,
            MembershipSubscriptions::class,
            'member_id',               // Foreign key on MembershipSubscriptions
            'membership_subscription_id', // Foreign key on SubscriptionPayments
            'id',                      // Local key on Members
            'id'                       // Local key on MembershipSubscriptions
        );
    }
}
