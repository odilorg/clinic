<?php

namespace App\Filament\Resources\LabTestResultResource\Pages;

use App\Filament\Resources\LabTestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLabTestResult extends EditRecord
{
    protected static string $resource = LabTestResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
