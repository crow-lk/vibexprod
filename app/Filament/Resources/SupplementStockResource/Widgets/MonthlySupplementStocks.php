<?php

namespace App\Filament\Resources\SupplementStockResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonthlySupplementStocks extends BaseWidget
{
    protected function getStats(): array
    {
        $currentDate = now();

        // Define the start date as the 12th of the current month
        $startDate = $currentDate->copy()->startOfMonth()->addDays(11); // 12th of the current month

        // Define the end date as the 11th of the next month
        $endDate = $currentDate->copy()->addMonth()->startOfMonth()->addDays(10); // 11th of the next month

        // Query the total cost of supplement stocks in the defined range (12th of current month to 11th of next month)
        $monthlySupplementStocks = \App\Models\SupplementStock::whereBetween('created_at', [$startDate, $endDate])->sum('total_cost');

        return [
            Stat::make('This Month\'s Total Supplement Stocks', $monthlySupplementStocks)->icon('heroicon-o-currency-dollar'),
        ];
    }
}
