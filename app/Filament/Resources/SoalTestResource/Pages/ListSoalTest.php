<?php

namespace App\Filament\Resources\SoalTestResource\Pages;

use App\Filament\Resources\SoalTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSoalTest extends ListRecords
{
    protected static string $resource = SoalTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
