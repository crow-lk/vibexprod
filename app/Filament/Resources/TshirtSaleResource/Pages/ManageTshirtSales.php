<?php

namespace App\Filament\Resources\TshirtSaleResource\Pages;

use App\Filament\Resources\TshirtSaleResource;
use App\Filament\Resources\TshirtSalesResource\Widgets\TodayTshirtSales;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTshirtSales extends ManageRecords
{
    protected static string $resource = TshirtSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array {
        return [
            TodayTshirtSales::make(),
        ];
    }
}
