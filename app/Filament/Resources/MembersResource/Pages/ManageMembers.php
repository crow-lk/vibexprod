<?php

namespace App\Filament\Resources\MembersResource\Pages;

use App\Filament\Resources\MembersResource;
use App\Filament\Resources\MembersResource\Widgets\MembersChart;
use App\Filament\Resources\MembersResource\Widgets\MembersOverview;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMembers extends ManageRecords
{
    protected static string $resource = MembersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }



	protected function getHeaderWidgets(): array
	{
		return [
			MembersOverview::make(),
		];
	}

	// protected function getFooterWidgets(): array
	// {
	// 	return [
	// 		MembersChart::make(),
	// 	];
	// }
}
