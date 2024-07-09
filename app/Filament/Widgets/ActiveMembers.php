<?php

namespace App\Filament\Widgets;

use App\Models\Customers;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActiveMembers extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active customers', Customers::count())
            ->description('Current Active Members')
            ->color('success'),
        ];
    }
}
