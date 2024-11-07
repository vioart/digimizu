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
            ExportColumn::make('user.name')->label('Nama'),
            ExportColumn::make('tanggal'),
            ExportColumn::make('waktu'),
            ExportColumn::make('status'),
            ExportColumn::make('keterangan'),
        ];
    }
     // Fungsi untuk mendapatkan data export
    public static function getExportData(): array
    {
        // Ambil data dengan eager load relasi user
        $absensiRecords = RiwayatAbsensi::with('user')->get();

        // Map data agar bisa diekspor dengan benar
        return $absensiRecords->map(function ($record) {
            return [
                'user_name' => $record->user ? $record->user->name : 'Unknown',  // Pastikan data user ada
                'tanggal' => $record->tanggal,
                'waktu' => $record->waktu,
                'status' => $record->status,
                'keterangan' => isset($record->keterangan) ? $record->keterangan : 'No Description',  // Pengecekan untuk keterangan
            ];
        })->toArray();
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
