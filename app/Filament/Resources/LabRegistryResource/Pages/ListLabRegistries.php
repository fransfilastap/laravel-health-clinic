<?php

namespace App\Filament\Resources\LabRegistryResource\Pages;

use App\Filament\Resources\LabRegistryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLabRegistries extends ListRecords
{
    protected static string $resource = LabRegistryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
