<?php

namespace App\Filament\Resources\SubscriptionPaymentsResource\Widgets;

use App\Models\SubscriptionPayments;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatePayments extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                SubscriptionPayments::query()
                    ->whereDate('next_pament_date', '<', now())
                    ->with('member')
            )
            ->columns([
                Tables\Columns\TextColumn::make('member.id')
                    ->label('Member ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('member.name')
                    ->label('Member Name')
                    ->sortable()
                    ->searchable(),
                
                //show next payment date
                Tables\Columns\TextColumn::make('next_pament_date')
                    ->label('Next Payment Date')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->sortable()
                    ->searchable(),

            ]);
    }
}
