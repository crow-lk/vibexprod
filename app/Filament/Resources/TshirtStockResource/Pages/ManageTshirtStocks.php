<?php

namespace App\Filament\Resources\TshirtStockResource\Pages;

use App\Filament\Resources\TshirtStockResource;
use App\Models\Tshirt;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTshirtStocks extends ManageRecords
{
    protected static string $resource = TshirtStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
