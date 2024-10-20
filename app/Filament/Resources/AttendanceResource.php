<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-s-document-check';
    protected static ?string $navigationGroup = 'Gym Member Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('member_id')
                ->relationship('member', 'name') // Fetch member names from the relationship
                ->required()
                ->searchable() // Enable live search
                ->label('Member'),

                Forms\Components\DateTimePicker::make('check_in_time')->required(),

                Forms\Components\DateTimePicker::make('check_out_time')->nullable(),

                Forms\Components\Select::make('status')
                    ->required()
                    ->label('Attendance Status')
                    ->options([
                        'present' => 'Present',
                        'not_checked_out' => 'Not Marked Check-out', // Using 'not_checked_out' as per your request
                    ])
                    ->default('present')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('member.name')
                    ->sortable()
                    ->searchable()
                    ->label('Member'),

                Tables\Columns\TextColumn::make('check_in_time')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('check_out_time')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('status')->sortable()->searchable()
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
            'index' => Pages\ManageAttendances::route('/'),
        ];
    }
}
