<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplementsResource\Pages;
use App\Filament\Resources\SupplementsResource\RelationManagers;
use App\Models\Supplements;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplementsResource extends Resource
{
    protected static ?string $model = Supplements::class;

    protected static ?string $navigationIcon = 'heroicon-s-bolt';
    //add to group supplements
    protected static ?string $navigationGroup = 'Supplements';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('price')->required(),
                Forms\Components\TextInput::make('cost_price')->required(),
                Forms\Components\TextInput::make('available_qty')->required(),
                //add image upload
                // Forms\Components\FileUpload::make('image')->image()->required(),
                Forms\Components\TextInput::make('description')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('price')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cost_price')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('available_qty')->sortable()->searchable(),
                // Tables\Columns\TextColumn::make('image')->sortable()->searchable(),
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
            'index' => Pages\ManageSupplements::route('/'),
        ];
    }
}
