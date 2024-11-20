<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplementStockResource\Pages;
use App\Filament\Resources\SupplementStockResource\RelationManagers;
use App\Models\SupplementStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplementStockResource extends Resource
{
    protected static ?string $model = SupplementStock::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';

    protected static ?string $navigationGroup = 'Supplements';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            // Supplement Dropdown
            Forms\Components\Select::make('supplement_id')
                ->relationship('supplement', 'name')
                ->required()
                ->placeholder('Select Supplement')
                ->searchable(),

            // Quantity Field
            Forms\Components\TextInput::make('quantity')
                ->required()
                ->numeric()
                ->reactive() // Reactivity ensures updates trigger calculations
                ->afterStateUpdated(function (callable $get, callable $set) {
                    $quantity = intval($get('quantity'));
                    $cost = floatval($get('cost'));
                    $set('total_cost', $quantity * $cost); // Calculate total cost
                }),

            // Cost Field
            Forms\Components\TextInput::make('cost')
                ->required()
                ->numeric()
                ->reactive() // Reactivity ensures updates trigger calculations
                ->afterStateUpdated(function (callable $get, callable $set) {
                    $quantity = intval($get('quantity'));
                    $cost = floatval($get('cost'));
                    $set('total_cost', $quantity * $cost); // Calculate total cost
                }),

            // Total Cost Field
            Forms\Components\TextInput::make('total_cost')
                ->numeric()
                ->disabled() // Make it read-only
                ->default(0)
                ->reactive(), // Ensure this field reacts to updates

            // Stocked At Field
            Forms\Components\DatePicker::make('stocked_at')
                ->required()
                ->default(now())
                ->label('Stocked At'),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplement.name')->label('Supplement')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('quantity')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cost')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('total_cost')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('stocked_at')->sortable()->searchable()
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
            'index' => Pages\ManageSupplementStocks::route('/'),
        ];
    }
}
