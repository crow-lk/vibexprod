<?php

namespace App\Filament\Resources;

use App\Filament\Resources\tshirtSaleResource\Pages;
use App\Filament\Resources\tshirtSaleResource\RelationManagers;
use App\Models\Tshirt;
use App\Models\TshirtSale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\ValidationException;

class TshirtSaleResource extends Resource
{
    protected static ?string $model = TshirtSale::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    protected static ?string $navigationGroup = 'T-Shirts';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            // tshirt Dropdown
            Forms\Components\Select::make('tshirt_id')
                ->relationship('tshirt', 'name') // Fetch tshirt name
                ->required()
                ->placeholder('Select tshirt')
                ->searchable()
                ->reactive() // Reacts to changes in tshirt selection
                ->afterStateUpdated(function (callable $get, callable $set) {
                    $tshirtId = $get('tshirt_id');
                    $quantity = intval($get('quantity')); // Ensure quantity is an integer
                    if ($tshirtId) {
                        $tshirt = \App\Models\Tshirt::find($tshirtId);
                        if ($tshirt) {
                            $set('total_price', floatval($tshirt->price) * $quantity);
                            $set('available_qty', $tshirt->available_qty);
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
                    $tshirtId = $get('tshirt_id');
                    $quantity = intval($get('quantity')); // Ensure quantity is an integer
                    if ($tshirtId) {
                        $tshirt = Tshirt::find($tshirtId);
                        if ($tshirt) {
                            if ($quantity > $tshirt->available_qty) {
                                // Show a notification if the quantity exceeds available stock
                                Notification::make()
                                    ->title('Stock Alert')
                                    ->body('Stocks not available. Available quantity: ' . $tshirt->available_qty)
                                    ->icon('heroicon-s-no-symbol')
                                    ->danger() // Set the notification as dangerous (red)
                                    ->send(); // Send the notification
                            }
                            $set('total_price', floatval($tshirt->price) * $quantity);
                        }
                    } else {
                        $set('total_price', 0);
                    }
                }),

            // size Dropdown
            Forms\Components\Select::make('size_id')
                ->relationship('sizes', 'size') // Fetch tshirt name
                ->required()
                ->placeholder('Select Size')
                ->reactive() // Reacts to changes in tshirt selection
                ->afterStateUpdated(function (callable $get, callable $set) {
                    $tshirtId = $get('tshirt_id');
                    $quantity = intval($get('quantity')); // Ensure quantity is an integer
                    if ($tshirtId) {
                        $tshirt = \App\Models\Tshirt::find($tshirtId);
                        if ($tshirt) {
                            $set('total_price', floatval($tshirt->price) * $quantity);
                            $set('available_qty', $tshirt->available_qty);
                        }
                    } else {
                        $set('total_price', 0);
                        $set('available_qty', 0);
                    }
                }),
            // Total Price Field (Read-Only)
            Forms\Components\TextInput::make('total_price')
                ->numeric()
                ->disabled() // Make it read-only
                ->label('Total Price')
                ->default(0), // Initialize with 0

            // Show available quantity of selected tshirt
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
                Tables\Columns\TextColumn::make('tshirt.name')->label('tshirt')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('sizes.size')->label('size')->sortable()->searchable(),
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
            'index' => Pages\ManageTshirtSales::route('/'),
        ];
    }
}
