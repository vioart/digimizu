<?php

namespace App\Filament\Exports;

use App\Models\RiwayatAbsensi;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class RiwayatAbsensiExporter extends Exporter
{
    protected static ?string $model = RiwayatAbsensi::class;

    public static function getColumns(): array
    {
        return [
            // ExportColumn::make('user_id'),
            ExportColumn::make('tanggal'),
            ExportColumn::make('waktu'),
            ExportColumn::make('status'),
            ExportColumn::make('Keterangan'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your riwayat absensi export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}