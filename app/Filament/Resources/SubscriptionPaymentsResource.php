<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionPaymentsResource\Pages;
use App\Filament\Resources\SubscriptionPaymentsResource\RelationManagers;
use App\Models\Members;
use App\Models\MembershipSubscriptions;
use App\Models\SubscriptionPayments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriptionPaymentsResource extends Resource
{
    protected static ?string $model = SubscriptionPayments::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Subscription Packages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('member_id')
                    ->label('Member')
                    ->options(Members::pluck('name', 'id')) // Get list of members
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(function (callable $set, $state) {
                        // Reset the subscription field when the member changes
                        $set('membership_subscription_id', null);
                    }),

                    Forms\Components\Select::make('membership_subscription_id')
                    ->label('Subscription Plan')
                    ->options(function (callable $get) {
                        $memberId = $get('member_id');
                        if ($memberId) {
                            return MembershipSubscriptions::where('member_id', $memberId)
                                ->with('subscription')
                                ->get()
                                ->mapWithKeys(function ($subscription) {
                                    $subscriptionName = $subscription->subscription->subscription_name ?? 'N/A';
                                    return [$subscription->id => $subscriptionName];
                                });
                        }
                        return [];
                    })
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $subscriptionId = $get('membership_subscription_id');
                        if ($subscriptionId) {
                            $subscription = MembershipSubscriptions::with('subscription')->find($subscriptionId);
                            if ($subscription && $subscription->subscription) {
                                // Set the amount to the subscription's price
                                $set('amount', $subscription->subscription->price);
                            } else {
                                $set('amount', null); // Set to null if no price is found
                            }
                        }
                    }),
                    

                // Amount Field (Reactive)
                Forms\Components\TextInput::make('amount')
                    ->label('Subscription Amount')
                    ->numeric()
                    ->required(), // Make it read-only as it's auto-filled
                Forms\Components\DateTimePicker::make('start_date')->required(),
                Forms\Components\DateTimePicker::make('next_pament_date')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('membershipSubscription.member.name')
                    ->label('Member Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('membershipSubscription.subscription.subscription_name')
                    ->label('Subscription Plan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Price')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('next_pament_date')->sortable()->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSubscriptionPayments::route('/'),
        ];
    }
}
