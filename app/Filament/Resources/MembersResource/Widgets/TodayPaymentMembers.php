<?php

namespace App\Filament\Resources\MembersResource\Widgets;

use App\Models\SubscriptionPayments;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class TodayPaymentMembers extends BaseWidget
{
    public function table(Table $table): Table
{
    return $table
        ->query(
            SubscriptionPayments::query()
                ->whereDate('next_pament_date', Carbon::today()) // Get today's records
                ->with('member') // Eager load member relationship
        )
        ->columns([
            Tables\Columns\TextColumn::make('member.id')
                ->label('Member Id')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('member.name')
                ->label('Member Name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('amount')
                ->label('Amount')
                ->sortable()
                ->searchable(),
        ]);
}
}
