<?php

namespace App\Filament\Resources\Widgets;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class TotalExpenses extends BaseWidget
{

    protected function getStats(): array
    {
        //get total expences
        $totalExpences = \App\Models\Expenses::sum('amount');
        return [
            Stat::make('Total Expences', $totalExpences)->icon('heroicon-o-currency-dollar'),
        ];
    }
}
