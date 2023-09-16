<?php

namespace App\Filament\Resources\MedicineRestockResource\Pages;

use App\Filament\Resources\MedicineRestockResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMedicineRestock extends ViewRecord
{
    protected static string $resource = MedicineRestockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
