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
use Carbon\Carbon;

class ProfitReport extends BaseWidget
{
    protected static string $view = 'filament.widgets.profit-report';

    public float $profit = 0.00;
    public float $totalExpenses = 0.00;
    public float $totalIncome = 0.00;
    public float $oneDay = 0.00;
    public float $subscriptionPay = 0.00;
    public float $supplimentSale = 0.00;
    public float $tshirtSale = 0.00;
    public float $supplimentCost = 0.00;
    public float $tshirtCost = 0.00;
    public float $expenses = 0.00;

    public ?string $startDate = null; // Initialize to null
    public ?string $endDate = null;   // Initialize to null

    protected int | string | array $columnSpan = 'full';

    public function mount(): void
    {
        // No default date range set
        $this->calculateFinancials();
    }

    public function updateFinancials(): void
    {
        $this->calculateFinancials();
    }

    public function calculateFinancials(): void
    {
        if ($this->startDate && $this->endDate) {
            $this->oneDay = OneDayPass::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('amount');
            $this->subscriptionPay = SubscriptionPayments::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('amount');
            $this->supplimentSale = SupplementSale::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('total_price');
            $this->tshirtSale = TshirtSale::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('total_price');
            $this->supplimentCost = SupplementStock::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('total_cost');
            $this->tshirtCost = TshirtStock::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('total_cost');
            $this->expenses = Expenses::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('amount');

            $this->totalIncome = $this->calculateTotalIncome();
            $this->totalExpenses = $this->calculateTotalExpenses();
            $this->profit = $this->calculateProfit();
        } else {
            // Reset values if dates are not set
            $this->oneDay = 0.00;
            $this->subscriptionPay = 0.00;
            $this->supplimentSale = 0.00;
            $this->tshirtSale = 0.00;
            $this->supplimentCost = 0.00;
            $this->tshirtCost = 0.00;
            $this->expenses = 0.00;
            $this->totalIncome = 0.00;
            $this->totalExpenses = 0.00;
            $this->profit = 0.00;
        }
    }

    protected function calculateTotalIncome(): float
    {
        return $this->supplimentSale + $this->oneDay + $this->tshirtSale + $this->subscriptionPay;
    }

    protected function calculateTotalExpenses(): float
    {
        return $this->expenses + $this->tshirtCost + $this->supplimentCost;
    }

    protected function calculateProfit(): float
    {
        return $this->totalIncome - $this->totalExpenses;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'startDate' || $propertyName === 'endDate') {
            $this->calculateFinancials();
        }
    }
}
