<?php

namespace App\Filament\Resources\Widgets;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


class TotalIncome extends BaseWidget
{
    protected function getStats(): array
    {
        // Get total Income
        $totalIncome = \App\Models\SupplementSale::sum('total_price');
        return [
            Stat::make('Total Income', $totalIncome)->icon('heroicon-o-currency-dollar'),
        ];
    }

}
