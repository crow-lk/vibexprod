<?php

namespace App\Filament\Resources\TshirtsResource\Pages;

use App\Filament\Resources\TshirtsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTshirts extends ManageRecords
{
    protected static string $resource = TshirtsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
