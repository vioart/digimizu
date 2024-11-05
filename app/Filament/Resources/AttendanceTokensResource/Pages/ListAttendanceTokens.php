<?php

namespace App\Filament\Resources\AttendanceTokensResource\Pages;

use App\Filament\Resources\AttendanceTokensResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttendanceTokens extends ListRecords
{
    protected static string $resource = AttendanceTokensResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
