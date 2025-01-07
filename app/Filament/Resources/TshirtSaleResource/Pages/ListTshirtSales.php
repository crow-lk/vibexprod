<?php

namespace App\Filament\Resources\TshirtSaleResource\Pages;

use App\Filament\Resources\TshirtSaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTshirtSales extends ListRecords
{
    protected static string $resource = TshirtSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
