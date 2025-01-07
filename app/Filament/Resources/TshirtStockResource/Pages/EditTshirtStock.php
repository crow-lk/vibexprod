<?php

namespace App\Filament\Resources\TshirtStockResource\Pages;

use App\Filament\Resources\TshirtStockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTshirtStock extends EditRecord
{
    protected static string $resource = TshirtStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
