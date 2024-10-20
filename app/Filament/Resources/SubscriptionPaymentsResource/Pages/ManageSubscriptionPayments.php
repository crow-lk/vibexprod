<?php

namespace App\Filament\Resources\SubscriptionPaymentsResource\Pages;

use App\Filament\Resources\SubscriptionPaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSubscriptionPayments extends ManageRecords
{
    protected static string $resource = SubscriptionPaymentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
