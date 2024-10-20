<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipSubscriptions extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'membership_subscriptions';
    protected $fillable = ['member_id','subscription_id','amount','payment_status'];

    public function member()
    {
        return $this->belongsTo(Members::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function subscriptionPayments()
    {
        return $this->hasMany(SubscriptionPayments::class, 'membership_subscription_id');
    }
}
