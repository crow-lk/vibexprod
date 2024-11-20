<?php

namespace App\Filament\Resources\SupplementStockResource\Pages;

use App\Filament\Resources\SupplementStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSupplementStocks extends ManageRecords
{
    protected static string $resource = SupplementStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
