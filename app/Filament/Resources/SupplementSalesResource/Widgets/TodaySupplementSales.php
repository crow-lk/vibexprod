<?php

namespace App\Filament\Resources\SupplementSalesResource\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TodaySupplementSales extends BaseWidget
{
    protected function getStats(): array
    {
        //get today's supplement sales
        $totalSupplementSales = \App\Models\SupplementSale::whereDate('created_at', Carbon::today())->sum('total_price');
        return [
            Stat::make('Today\'s  Total Supplement Sales', $totalSupplementSales)->icon('heroicon-o-currency-dollar'),  
        ];
    }
}
