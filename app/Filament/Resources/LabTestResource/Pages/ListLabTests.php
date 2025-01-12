<?php

namespace App\Filament\Resources\LabTestResource\Pages;

use App\Filament\Resources\LabTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLabTests extends ListRecords
{
    protected static string $resource = LabTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
