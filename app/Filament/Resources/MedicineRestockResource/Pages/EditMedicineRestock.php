<?php

namespace App\Filament\Resources\MedicineRestockResource\Pages;

use App\Filament\Resources\MedicineRestockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicineRestock extends EditRecord
{
    protected static string $resource = MedicineRestockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
