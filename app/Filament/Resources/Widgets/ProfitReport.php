<?php

namespace App\Filament\Resources\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\SupplementSale;
use App\Models\Expenses;
use App\Models\OneDayPass;
use App\Models\TshirtSale;
use App\Models\SubscriptionPayments;
use App\Models\SupplementStock;
use App\Models\TshirtStock;

class ProfitReport extends BaseWidget
{
    protected static string $view = 'filament.widgets.profit-report';

    public float $profit;
    public float $totalExpenses;
    public float $totalIncome;
    public $oneDay;
    public $subscriptionPay;
    public $supplimentSale;
    public $tshirtSale;
    public $supplimentCost;
    public $tshirtCost;
    public $expenses;

    protected int | string | array $columnSpan = 'full';


    public function mount(): void
    {
        $this->oneDay = OneDayPass::sum('amount');
        $this->subscriptionPay = SubscriptionPayments::sum('amount');
        $this->supplimentSale = SupplementSale::sum('total_price');
        $this->tshirtSale = TshirtSale::sum('total_price');
        $this->supplimentCost = SupplementStock::sum('total_cost');
        $this->tshirtCost = TshirtStock::sum('total_cost');
        $this->expenses = Expenses::sum('amount');
        $this->totalIncome = $this->calculateTotalIncome();
        $this->totalExpenses = $this->calculateTotalExpenses();
        $this->profit = $this->calculateProfit();
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

    protected function calculateProfit(): float
    {
        return $this->totalIncome - $this->totalExpenses;
    }
}
