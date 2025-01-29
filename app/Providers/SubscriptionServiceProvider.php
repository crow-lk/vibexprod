<?php

// namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\Log;
// use App\Models\SubscriptionPayments;

// class SubscriptionServiceProvider extends ServiceProvider
// {
//     public function boot()
//     {
//         // Schedule the payment reminder check
//         $this->app['scheduler']->call(function () {
//             SubscriptionPayments::sendPaymentReminders();
//         })->daily(); // Adjust the frequency as needed
//     }
// }
