<?php

namespace App\Filament\Resources\SubscriptionPaymentsResource\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TodayPayments extends BaseWidget
{
    protected function getStats(): array
    {
        //get today's payments
        $totalPayments = \App\Models\SubscriptionPayments::whereDate('created_at', Carbon::today())->sum('amount');
        return [
            Stat::make('Today\'s  Total Payments', $totalPayments)->icon('heroicon-o-currency-dollar'),
        ];
    }
}
