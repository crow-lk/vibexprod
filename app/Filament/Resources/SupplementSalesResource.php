<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplementSalesResource\Pages;
use App\Filament\Resources\SupplementSalesResource\RelationManagers;
use App\Models\SupplementSale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\ValidationException;

class SupplementSalesResource extends Resource
{
    protected static ?string $model = SupplementSale::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    protected static ?string $navigationGroup = 'Supplements';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            // Supplement Dropdown
            Forms\Components\Select::make('supplement_id')
                ->relationship('supplement', 'name') // Fetch supplement name
                ->required()
                ->placeholder('Select Supplement')
                ->searchable()
                ->reactive() // Reacts to changes in supplement selection
                ->afterStateUpdated(function (callable $get, callable $set) {
                    $supplementId = $get('supplement_id');
                    $quantity = intval($get('quantity')); // Ensure quantity is an integer
                    if ($supplementId) {
                        $supplement = \App\Models\Supplements::find($supplementId);
                        if ($supplement) {
                            $set('total_price', floatval($supplement->price) * $quantity);
                            $set('available_qty', $supplement->available_qty);
                        }
                    } else {
                        $set('total_price', 0);
                        $set('available_qty', 0);
                    }
                }),

            // Quantity Input
            Forms\Components\TextInput::make('quantity')
                ->numeric()
                ->required()
                ->reactive() // Reacts to changes in quantity
                ->afterStateUpdated(function (callable $get, callable $set) {
                    $supplementId = $get('supplement_id');
                    $quantity = intval($get('quantity')); // Ensure quantity is an integer
                    if ($supplementId) {
                        $supplement = \App\Models\Supplements::find($supplementId);
                        if ($supplement) {
                            $set('total_price', floatval($supplement->price) * $quantity);
                        }
                    } else {
                        $set('total_price', 0);
                    }
                }),

            // Total Price Field (Read-Only)
            Forms\Components\TextInput::make('total_price')
                ->numeric()
                ->disabled() // Make it read-only
                ->label('Total Price')
                ->default(0), // Initialize with 0

            // Show available quantity of selected supplement
            Forms\Components\TextInput::make('available_qty')
                ->disabled()
                ->label('Available Quantity')
                ->default(0), // Initialize with 0
        ]);

        

}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplement.name')->label('Supplement')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('quantity')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('total_price')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->sortable()->searchable()->label('Date'),
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
            'index' => Pages\ManageSupplementSales::route('/'),
        ];
    }
}
