<?php

namespace App\Filament\Resources\SubscriptionPaymentsResource\Pages;

use App\Filament\Resources\SubscriptionPaymentsResource;
use App\Filament\Resources\SubscriptionPaymentsResource\Widgets\TodayPayments;
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

    protected function getHeaderWidgets(): array
	{
		return [
			TodayPayments::make(),
		];
	}}
