<?php

namespace App\Filament\Resources\LabRegistryResource\Pages;

use App\Filament\Resources\LabRegistryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLabRegistry extends EditRecord
{
    protected static string $resource = LabRegistryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
