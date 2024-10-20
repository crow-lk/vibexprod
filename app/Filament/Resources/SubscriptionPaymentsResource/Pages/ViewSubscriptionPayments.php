<?php

namespace App\Filament\Resources\SubscriptionPaymentsResource\Pages;

use App\Filament\Resources\SubscriptionPaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSubscriptionPayments extends ViewRecord
{
    protected static string $resource = SubscriptionPaymentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
