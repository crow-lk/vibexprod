<?php

namespace App\Filament\Resources\SubscriptionPaymentsResource\Pages;

use App\Filament\Resources\SubscriptionPaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubscriptionPayments extends EditRecord
{
    protected static string $resource = SubscriptionPaymentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
