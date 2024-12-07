<?php

namespace App\Filament\Resources\SupplementSalesResource\Pages;

use App\Filament\Resources\SupplementSalesResource;
use App\Filament\Resources\SupplementSalesResource\Widgets\TodaySupplementSales;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSupplementSales extends ManageRecords
{
    protected static string $resource = SupplementSalesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array {
        return [
            TodaySupplementSales::make(),
        ];
    }
}
