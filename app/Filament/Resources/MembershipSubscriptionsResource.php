<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MembershipSubscriptionsResource\Pages;
use App\Filament\Resources\MembershipSubscriptionsResource\RelationManagers;
use App\Models\MembershipSubscriptions;
use App\Models\Subscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembershipSubscriptionsResource extends Resource
{
    protected static ?string $model = MembershipSubscriptions::class;

    protected static ?string $navigationIcon = 'heroicon-s-flag';

    protected static ?string $navigationGroup = 'Subscription Packages';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('member_id')
                    ->relationship('member', 'name')
                    ->required()
                    ->label('Member')
                    ->searchable() // Enable live search
                    ->placeholder('Search for a member...') // Optional: Set a placeholder
                    ->reactive(),

                Forms\Components\Select::make('subscription_id')
                    ->label('Subscription Plan')
                    ->relationship('subscription', 'subscription_name')
                    ->required()
                    ->reactive()  // Enables event listener
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $currentSubscriptionId = $get('subscription_id'); // Get the current state value
                        if ($currentSubscriptionId) {
                            // Fetch the price based on the current subscription ID
                            $subscription = \App\Models\Subscription::find($currentSubscriptionId);
                            if ($subscription) {
                                $set('amount', $subscription->price); // Set the amount field with the subscription price
                            }
                        }
                    }),
                    
                Forms\Components\TextInput::make('amount')
                    ->label('Amount')
                    ->required()
                    ->disabled()  // Prevent manual input since it’s auto-filled
                    ->numeric(),

                Forms\Components\Select::make('payment_status')
                    ->required()
                    ->label('Payment Status')
                    ->options([
                        'paid' => 'Paid',
                        'not_paid' => 'Not Paid',
                        'pending' => 'Pending'
                        ])
                    ->default('Not Paid')
                    ->preload(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('member_id') // Display member ID
                    ->label('Member ID')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('member.name') // Display member name
                    ->label('Member Name')
                    ->sortable()
                    ->searchable(),

               
                Tables\Columns\TextColumn::make('subscription.subscription_name')
                    ->label('Subscription Plan') // Display the subscription plan
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('payment_status')->sortable()->searchable()
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
            'index' => Pages\ManageMembershipSubscriptions::route('/'),
        ];
    }
}
