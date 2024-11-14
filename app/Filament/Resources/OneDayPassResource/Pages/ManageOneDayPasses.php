<?php

namespace App\Filament\Resources\OneDayPassResource\Pages;

use App\Filament\Resources\OneDayPassResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOneDayPasses extends ManageRecords
{
    protected static string $resource = OneDayPassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
