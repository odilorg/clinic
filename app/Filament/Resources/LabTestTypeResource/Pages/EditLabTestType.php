<?php

namespace App\Filament\Resources\LabTestTypeResource\Pages;

use App\Filament\Resources\LabTestTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLabTestType extends EditRecord
{
    protected static string $resource = LabTestTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
