<?php

namespace App\Filament\Resources\TshirtStockResource\Pages;

use App\Filament\Resources\TshirtStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTshirtStocks extends ListRecords
{
    protected static string $resource = TshirtStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
