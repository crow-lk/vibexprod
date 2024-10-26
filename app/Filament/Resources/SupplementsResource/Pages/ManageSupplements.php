<?php

namespace App\Filament\Resources\SupplementsResource\Pages;

use App\Filament\Resources\SupplementsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSupplements extends ManageRecords
{
    protected static string $resource = SupplementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
