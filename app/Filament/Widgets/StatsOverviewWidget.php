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
            Stat::make('Anggota Magang', User::where('role', 'anggota_magang')->where('is_active', 1)->count()),
            Stat::make('Selesai Magang', User::where('role', 'anggota_magang')->where('is_active', 0)->count()),
            Stat::make('Total Calon Magang', CalonMagang::count()),
            Stat::make('Total Absensi Hari Ini', Absensi::whereDate('tanggal', today())->count()),
        ];
    }
}