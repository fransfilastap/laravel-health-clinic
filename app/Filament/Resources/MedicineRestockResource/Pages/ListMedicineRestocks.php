<?php

namespace App\Filament\Resources\MedicineRestockResource\Pages;

use App\Filament\Resources\MedicineRestockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicineRestocks extends ListRecords
{
    protected static string $resource = MedicineRestockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
