<?php

namespace App\Filament\Resources\SoalTestResource\Pages;

use App\Filament\Resources\SoalTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSoalTest extends EditRecord
{
    protected static string $resource = SoalTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
