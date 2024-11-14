<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OneDayPassResource\Pages;
use App\Filament\Resources\OneDayPassResource\RelationManagers;
use App\Models\OneDayPass;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OneDayPassResource extends Resource
{
    protected static ?string $model = OneDayPass::class;

    protected static ?string $navigationIcon = 'heroicon-s-arrow-up-on-square';

    protected static ?string $navigationGroup = 'Gym Member Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('nic')->required()->label('NIC'),
                Forms\Components\TextInput::make('phone')->required(),
                Forms\Components\TextInput::make('email'),
                Forms\Components\TextInput::make('address'),
                Forms\Components\TextInput::make('amount')->required()->inputMode('decimal')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nic')->sortable()->searchable()->label('NIC'),
                Tables\Columns\TextColumn::make('phone')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('address')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('amount')->sortable()->searchable(),
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
            'index' => Pages\ManageOneDayPasses::route('/'),
        ];
    }
}
