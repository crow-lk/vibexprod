<?php

namespace App\Filament\Resources\Widgets;

use Filament\Widgets\Widget;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Component;

class ProfitReport extends Widget
{

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Component::make('Revenues')->label('Revenues')->columns([
                    TextColumn::make('sales')->label('Sales')->sortable(),
                    TextColumn::make('scrap_sales')->label('Scrap Sales')->sortable(),
                    TextColumn::make('interest_income')->label('Interest Income')->sortable(),
                ]),
                Component::make('Expenses')->label('Expenses')->columns([
                    TextColumn::make('cost_of_goods_sold')->label('Cost of Goods Sold')->sortable(),
                    TextColumn::make('rent')->label('Rent')->sortable(),
                    TextColumn::make('wages')->label('Wages')->sortable(),
                    TextColumn::make('depreciation')->label('Depreciation')->sortable(),
                    TextColumn::make('utilities')->label('Utilities')->sortable(),
                ]),
                TextColumn::make('total_revenues')->label('Total Revenues (A)')->sortable(),
                TextColumn::make('total_expenses')->label('Total Expenses (B)')->sortable(),
                TextColumn::make('net_income')->label('Net Income (A-B)')->sortable(),
            ])
            ->data($this->getData())
            ->defaultSort('total_revenues', 'desc')
            ->striped()
            ->bordered();
    }

    protected function getData()
    {
        // Fetch or define your data here
        return [
            [
                'sales' => '100,000.00',
                'scrap_sales' => '9,000.00',
                'interest_income' => '4,000.00',
                'cost_of_goods_sold' => '60,000.00',
                'rent' => '5,500.00',
                'wages' => '15,000.00',
                'depreciation' => '7,700.00',
                'utilities' => '9,000.00',
                'total_revenues' => '113,000.00',
                'total_expenses' => '97,200.00',
                'net_income' => '15,800.00',
            ],
        ];
    }
}
