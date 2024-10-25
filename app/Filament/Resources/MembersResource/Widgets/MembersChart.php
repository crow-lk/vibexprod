<?php

namespace App\Filament\Resources\MembersResource\Widgets;

use Filament\Widgets\ChartWidget;

class MembersChart extends ChartWidget
{
    protected static ?string $heading = 'Active & Inactive Members';

	//reducing the chart size
	protected static int $columns = 2;

    protected function getData(): array
    {
		$totalMembers = \App\Models\Members::where('membership_status', 'active')->count();
		$inactiveMembers = \App\Models\Members::where('membership_status', 'inactive')->count();
        return [
            'datasets' => [
				[
					'data' => [
						$totalMembers,
						$inactiveMembers,
					],
					'backgroundColor' => [
						'#008000',
						'#f43378',
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
