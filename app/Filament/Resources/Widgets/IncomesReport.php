<?php

namespace App\Filament\Resources\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\SupplementSale;
use App\Models\Expenses;
use App\Models\OneDayPass;
use App\Models\TshirtSale;
use App\Models\SubscriptionPayments;
use Illuminate\Database\Eloquent\Collection as EloquentCollection; // Import the Eloquent Collection

class IncomesReport extends BaseWidget
{
    protected static string $view = 'filament.widgets.income-report';

    public float $totalIncome = 0.00;
    public float $oneDay = 0.00;
    public float $subscriptionPay = 0.00;
    public float $supplimentSale = 0.00;
    public float $tshirtSale = 0.00;

    public ?string $startDate = null; // Initialize to null
    public ?string $endDate = null;   // Initialize to null

    public EloquentCollection $supplementSales; // Use EloquentCollection
    public EloquentCollection $tshirtSales; // Use EloquentCollection
    public EloquentCollection $subscriptionPayments; // Use EloquentCollection
    public EloquentCollection $oneDayPay; // Use EloquentCollection

    protected int | string | array $columnSpan = 'full';

    public function mount(): void
    {
        // Initialize collections
        $this->supplementSales = new EloquentCollection(); // Initialize as an empty Eloquent Collection
        $this->tshirtSales = new EloquentCollection(); // Initialize as an empty Eloquent Collection
        $this->subscriptionPayments = new EloquentCollection(); // Initialize as an empty Eloquent Collection
        $this->oneDayPay = new EloquentCollection(); // Initialize as an empty Eloquent Collection
        // Calculate financials
        $this->calculateFinancials();
    }

    public function updateFinancials(): void
    {
        $this->calculateFinancials();
    }

    public function calculateFinancials(): void
    {
        if ($this->startDate && $this->endDate) {
            // Retrieve all records within the date range
            $this->oneDay = OneDayPass::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('amount');
            $this->subscriptionPay = SubscriptionPayments::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('amount');
            $this->supplimentSale = SupplementSale::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('total_price');
            $this->tshirtSale = TshirtSale::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('total_price');

            // Retrieve all items for each category
            $this->supplementSales = SupplementSale::with('supplement') // Eager load the supplement relationship
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->get();
            $this->tshirtSales = TshirtSale::with('tshirt') // Eager load the tshirt relationship
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->get();
            $this->subscriptionPayments = SubscriptionPayments::with('membershipSubscription.subscription') // Eager load the membership subscription and subscription relationships
                ->whereBetween('created_at', [$this->startDate, $this->endDate])
                ->get();
            $this->oneDayPay = OneDayPass::whereBetween('created_at', [$this->startDate, $this->endDate])->get();

            // Calculate total income
            $this->totalIncome = $this->calculateTotalIncome();
        } else {
            // Reset values if dates are not set
            $this->oneDay = 0.00;
            $this->subscriptionPay = 0.00;
            $this->supplimentSale = 0.00;
            $this->tshirtSale = 0.00;
            $this->totalIncome = 0.00;
            $this->supplementSales = new EloquentCollection(); // Reset to empty Eloquent Collection
            $this->tshirtSales = new EloquentCollection(); // Reset to empty Eloquent Collection
            $this->subscriptionPayments = new EloquentCollection(); // Reset to empty Eloquent Collection
            $this->oneDayPay = new EloquentCollection(); // Reset to empty Eloquent Collection
        }
    }

    protected function calculateTotalIncome(): float
    {
        return $this->supplimentSale + $this->oneDay + $this->tshirtSale + $this->subscriptionPay;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'startDate' || $propertyName === 'endDate') {
            $this->calculateFinancials();
        }
    }
}
