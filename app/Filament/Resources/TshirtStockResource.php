<?php

namespace App\Filament\Resources;

use App\Filament\Resources\tshirtStockResource\Pages;
use App\Filament\Resources\tshirtStockResource\RelationManagers;
use App\Models\TshirtStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TshirtStockResource extends Resource
{
    protected static ?string $model = TshirtStock::class;

    protected static ?string $navigationIcon = 'heroicon-s-cube';

    protected static ?string $navigationGroup = 'T-Shirts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tshirt_id')
                    ->relationship('tshirt', 'name') // Fetch tshirt name
                    ->required()
                    ->placeholder('Select T-Shirt')
                    ->searchable(),

                Forms\Components\Select::make('size_id')
                    ->relationship('sizes', 'size') // Fetch tshirt size
                    ->required()
                    ->placeholder('Select Size'),

                Forms\Components\TextInput::make('quantity')->required()->reactive()->debounce(500)
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $quantity = intval($get('quantity'));
                        $cost = floatval($get('cost'));
                        $set('total_cost', $quantity * $cost); // Calculate total cost
                    }),

                Forms\Components\TextInput::make('cost')->required()->numeric()->reactive()->debounce(500) // Reactivity ensures updates trigger calculations
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $quantity = intval($get('quantity'));
                        $cost = floatval($get('cost'));
                        $set('total_cost', $quantity * $cost); // Calculate total cost
                    }),

                Forms\Components\TextInput::make('total_cost')
                    ->numeric()
                    ->disabled() // Make it read-only
                    ->default(0),

                Forms\Components\DatePicker::make('stocked_at')->required()->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tshirt.name')->label('tshirt')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('sizes.size')->label('size')->sortable()->searchable(),
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
            'index' => Pages\ManageTshirtStocks::route('/'),
        ];
    }
}
