<?php

namespace App\Filament\Resources\TshirtSalesResource\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TodayTshirtSales extends BaseWidget
{
    protected function getStats(): array
    {
        //get today's Tshirt sales
        $totalTshirtSales = \App\Models\TshirtSale::whereDate('created_at', Carbon::today())->sum('total_price');
        return [
            Stat::make('Today\'s  Total Tshirt Sales', $totalTshirtSales)->icon('heroicon-o-currency-dollar'),
        ];
    }
}
