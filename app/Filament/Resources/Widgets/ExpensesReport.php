<?php

namespace App\Filament\Resources\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\Expenses;
use App\Models\SupplementStock;
use App\Models\TshirtStock;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Carbon\Carbon;

class ExpensesReport extends BaseWidget
{
    protected static string $view = 'filament.widgets.expense-report';

    public float $totalExpenses = 0.00;
    public float $supplimentCost = 0.00;
    public float $tshirtCost = 0.00;
    public float $expenses = 0.00;

    public ?string $startDate = null; // Initialize to null
    public ?string $endDate = null;   // Initialize to null

    public EloquentCollection $supplementCosts; // Use EloquentCollection
    public EloquentCollection $tshirtCosts; // Use EloquentCollection
    public EloquentCollection $expense; // Use EloquentCollection

    protected int | string | array $columnSpan = 'full';

    public function mount(): void
    {
        // Initialize collections
        $this->supplementCosts = new EloquentCollection(); // Initialize as an empty Eloquent Collection
        $this->tshirtCosts = new EloquentCollection(); // Initialize as an empty Eloquent Collection
        $this->expense = new EloquentCollection(); // Initialize as an empty Eloquent Collection
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
            $this->supplimentCost = SupplementStock::whereBetween('stocked_at', [$this->startDate, $this->endDate])->sum('total_cost');
            $this->tshirtCost = TshirtStock::whereBetween('stocked_at', [$this->startDate, $this->endDate])->sum('total_cost');
            $this->expenses = Expenses::whereBetween('created_at', [$this->startDate, $this->endDate])->sum('amount');

            // Retrieve all items for each category
            $this->supplementCosts = SupplementStock::with('supplement') // Eager load the supplement relationship
                ->whereBetween('stocked_at', [$this->startDate, $this->endDate])
                ->get();
            $this->tshirtCosts = TshirtStock::with('tshirt') // Eager load the tshirt relationship
                ->whereBetween('stocked_at', [$this->startDate, $this->endDate])
                ->get();
            $this->expense = Expenses::whereBetween('created_at', [$this->startDate, $this->endDate])->get();

            $this->totalExpenses = $this->calculateTotalExpenses();
        } else {
            // Reset values if dates are not set
            $this->supplimentCost = 0.00;
            $this->tshirtCost = 0.00;
            $this->expenses = 0.00;
            $this->totalExpenses = 0.00;
            $this->supplementCosts = new EloquentCollection(); // Reset to empty Eloquent Collection
            $this->tshirtCosts = new EloquentCollection(); // Reset to empty Eloquent Collection
            $this->expense = new EloquentCollection(); // Reset to empty Eloquent Collection
        }
    }

    protected function calculateTotalExpenses(): float
    {
        return $this->expenses + $this->tshirtCost + $this->supplimentCost;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'startDate' || $propertyName === 'endDate') {
            $this->calculateFinancials();
        }
    }
}
