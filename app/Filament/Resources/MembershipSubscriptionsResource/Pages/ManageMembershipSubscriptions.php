<?php

namespace App\Filament\Resources\MembershipSubscriptionsResource\Pages;

use App\Filament\Resources\MembershipSubscriptionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMembershipSubscriptions extends ManageRecords
{
    protected static string $resource = MembershipSubscriptionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
