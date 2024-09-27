<?php

namespace App\Filament\Resources\CalonMagangResource\Pages;

use App\Filament\Resources\CalonMagangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCalonMagang extends ListRecords
{
    protected static string $resource = CalonMagangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
