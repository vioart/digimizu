<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\CalonMagang;
use App\Models\Absensi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Anggota Magang', User::where('role', 'anggota_magang')->count()),
            Stat::make('Total Calon Magang', CalonMagang::count()),
            Stat::make('Total Absensi Hari Ini', Absensi::whereDate('tanggal', today())->count()),
        ];
    }
}