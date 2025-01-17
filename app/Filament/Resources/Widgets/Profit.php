<?php

namespace App\Filament\Resources\Widgets;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


class Profit extends BaseWidget
{
    protected function getStats(): array
    {
        $totalIncome = \App\Models\SupplementSale::sum('total_price');
        $totalExpences = \App\Models\Expenses::sum('amount');

        // Get total Income
        $profit = $totalIncome - $totalExpences;
        return [
            Stat::make('Total Profit', $profit)->icon('heroicon-o-currency-dollar'),
        ];
    }

}

