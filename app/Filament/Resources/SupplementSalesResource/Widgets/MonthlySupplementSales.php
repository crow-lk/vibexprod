<?php

namespace App\Filament\Resources\SupplementSalesResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonthlySupplementSales extends BaseWidget
{
    protected function getStats(): array
    {
        $monthlySupplementSales = \App\Models\SupplementSale::whereMonth('created_at', date('m'))->sum('total_price');
        return [
            Stat::make('This Month\'s Total Supplement Sales', $monthlySupplementSales)->icon('heroicon-o-currency-dollar'),
        ];
    }
}
