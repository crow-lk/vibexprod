<?php

namespace App\Filament\Resources\SupplementStockResource\Pages;

use App\Filament\Resources\SupplementStockResource;
use App\Filament\Resources\SupplementStockResource\Widgets\MonthlySupplementStocks;
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

    protected function getHeaderWidgets(): array {
        return [
            MonthlySupplementStocks::make(),
        ];
    }
}
