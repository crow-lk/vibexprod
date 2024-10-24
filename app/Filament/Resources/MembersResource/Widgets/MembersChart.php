<?php

namespace App\Filament\Resources\MembersResource\Widgets;

use Filament\Widgets\ChartWidget;

class MembersChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
		$totalMembers = \App\Models\Members::count();
		$inactiveMembers = \App\Models\Members::where('membership_status', 'inactive')->count();
        return [
            'datasets' => [
				[
					'data' => [
						$totalMembers,
						$inactiveMembers,
					],
					'backgroundColor' => [
						'#3490dc',
						'#f6993f',
					],
				],
			],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
