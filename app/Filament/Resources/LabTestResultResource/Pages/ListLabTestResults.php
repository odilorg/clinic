<?php

namespace App\Filament\Resources\LabTestResultResource\Pages;

use App\Filament\Resources\LabTestResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLabTestResults extends ListRecords
{
    protected static string $resource = LabTestResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
