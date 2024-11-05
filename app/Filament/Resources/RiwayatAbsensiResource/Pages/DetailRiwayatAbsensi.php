<?php

namespace App\Filament\Resources\RiwayatAbsensiResource\Pages;

use App\Filament\Resources\RiwayatAbsensiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class DetailRiwayatAbsensi extends ListRecords
{
    protected static string $resource = RiwayatAbsensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Kembali')
                ->url(route('filament.resources.riwayat-absensi.index')),
        ];
    }
}
