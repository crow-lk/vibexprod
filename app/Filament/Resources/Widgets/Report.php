<?php

namespace App\Filament\Resources\Widgets;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\SupplementSale;
use App\Models\Expenses;
use App\Models\OneDayPass;
use App\Models\TshirtSale;
use App\Models\SubscriptionPayments;
use App\Models\SupplementStock;
use App\Models\TshirtStock;


class Report extends BaseWidget
{

    protected function getStats(): array
    {
        // Get total Income
        $totalIncome = $this->calculateTotalIncome();
        $totalExpenses = $this->calculateTotalExpenses();
        $profit = $totalIncome - $totalExpenses;

        if ($profit < 0) {
            $profit = abs($profit);
            $title = 'Total Loss';
        } else {
            $title = 'Total Profit';
        }

        return [
            Stat::make('Total Income', number_format($totalIncome, 2))->icon('heroicon-o-currency-dollar'),
            Stat::make('Total Expenses', number_format($totalExpenses, 2))->icon('heroicon-o-currency-dollar'),
            Stat::make($title, number_format($profit, 2))->icon('heroicon-o-currency-dollar'),
        ];
    }

    protected function calculateTotalIncome(): float
    {
        return SupplementSale::sum('total_price') +
               OneDayPass::sum('amount') +
               TshirtSale::sum('total_price') +
               SubscriptionPayments::sum('amount');
    }

    protected function calculateTotalExpenses(): float
    {
        return Expenses::sum('amount') +
               TshirtStock::sum('total_cost') +
               SupplementStock::sum('total_cost');
    }


}
