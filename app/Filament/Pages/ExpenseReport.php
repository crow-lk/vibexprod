<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Widgets\ExpensesReport;
use App\Models\SubscriptionPayments;
use Filament\Pages\Page;

class ExpenseReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Reports';
    protected static string $view = 'filament.pages.expense-report';

    public $totalPayments;
    public $monthlyPayments;

    public function mount()
    {
        // Calculate totals and group by month
        $this->totalPayments = $this->totalSubscriptionPayments();
        $this->monthlyPayments = $this->monthlySubscriptionPayments();
    }

    public function totalSubscriptionPayments()
    {
        return SubscriptionPayments::sum('amount');
    }

    public function monthlySubscriptionPayments()
    {
        return SubscriptionPayments::selectRaw('MONTHNAME(created_at) as month, MONTH(created_at) as month_number, SUM(amount) as total')
            ->groupByRaw('MONTHNAME(created_at), MONTH(created_at)')
            ->orderByRaw('month_number')
            ->get();
    }

    //function to change values according to selected date range from date picker
    public function changeDateRange($dateRange)
    {
        $this->totalPayments = SubscriptionPayments::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])->sum('amount');
        $this->monthlyPayments = SubscriptionPayments::selectRaw('MONTHNAME(created_at) as month, MONTH(created_at) as month_number, SUM(amount) as total')
            ->whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
            ->groupByRaw('MONTHNAME(created_at), MONTH(created_at)')
            ->orderByRaw('month_number')
            ->get();
    }

    public function getHeaderWidgets(): array
    {
        return [
            ExpensesReport::make(),
        ];
    }
}
