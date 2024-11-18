<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TshirtsResource\Pages;
use App\Filament\Resources\TshirtsResource\RelationManagers;
use App\Models\Tshirt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TshirtsResource extends Resource
{
    protected static ?string $model = Tshirt::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'T-Shirts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('size')->required()->options([
                    'small' => 'Small',
                    'medium' => 'Medium',
                    'large' => 'Large',
                    'extra_large' => 'Extra Large',
                    'double_extra_large' => 'Double Extra Large',
                ]),
                Forms\Components\TextInput::make('available_qty')->required(),
                Forms\Components\TextInput::make('description')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('size')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('available_qty')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable()
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
            'index' => Pages\ManageTshirts::route('/'),
        ];
    }
}
