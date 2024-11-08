<?php

namespace App\Models;

use Illuminate\Container\Attributes\Log;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log as FacadesLog;
use NotifyLk\Api\SmsApi;

class SubscriptionPayments extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'subscription_payments';
    protected $fillable = ['membership_subscription_id', 'start_date', 'next_pament_date', 'amount'];


    protected static function booted()
    {
        static::saved(function ($member) {
            if ($member->membershipSubscription && $member->member) {
                // Update statuses
                $member->membershipSubscription->update(['payment_status' => 'paid']);
                $member->member->update(['membership_status' => 'active']);
    
                // Send SMS notification with dynamic values
                $nextPaymentDate = Date($member->next_pament_date); // Ensure this field is correct
                $amount = $member->amount;
                self::sendSmsNotification(
                    self::formatPhoneNumber($member->member->phone),
                    $member->member->name,
                    $amount,
                    $nextPaymentDate
                );
            }
        });
    }

    public static function formatPhoneNumber($phone)
    {
        if (substr($phone, 0, 1) === '0') {
            return '94' . substr($phone, 1);
        }

        // If the phone already starts with the country code, return it as-is
        return $phone;
    }

    public static function sendSmsNotification($phone, $name, $amount, $nextPaymentDate)
    {
        $api_instance = new SmsApi();
        $user_id = "28149";  // Replace with your actual user ID
        $api_key = "kcbRA8aZ9ZRnhgfpUwyT";  // Replace with your actual API key
        $message = "Your subscription payment of LKR $amount was successful. Your next payment is due on $nextPaymentDate Thank you for being a member of VibeX Fitness!";
        $to = $phone;  // Format phone number with country code (e.g., 9477XXXXXXX)
        $sender_id = "Vibex";
        $contact_fname = $name;
        $contact_lname = "";
        $contact_email = "";
        $contact_address = "";
        $contact_group = 0;
        $type = null;

        try {
            $api_instance->sendSMS(
                $user_id,
                $api_key,
                $message,
                $to,
                $sender_id,
                $contact_fname,
                $contact_lname,
                $contact_email,
                $contact_address,
                $contact_group,
                $type
            );
        } catch (\Exception $e) {
            //show the sms as notofication to user
            FacadesLog::error('Exception when calling SmsApi->sendSMS: ' . $e->getMessage());
        }
    }


    public function membershipSubscription()
    {
        return $this->belongsTo(MembershipSubscriptions::class, 'membership_subscription_id');
    }



    public function member()
    {
        return $this->hasOneThrough(
            Members::class,           // Final model we want to access
            MembershipSubscriptions::class, // Intermediate model
            'id',                     // Foreign key on MembershipSubscriptions table
            'id',                     // Foreign key on Members table
            'membership_subscription_id', // Local key on SubscriptionPayments table
            'member_id'               // Local key on MembershipSubscriptions table
        );
    }

    public function subscriptionPayments()
    {
        return $this->hasMany(SubscriptionPayments::class, 'membership_subscription_id');
    }
}
