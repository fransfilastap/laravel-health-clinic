<?php

namespace App\Filament\Resources\MedicalRecordResource\Pages;

use App\Exceptions\NumberOfMedicineExceedStockException;
use App\Filament\Resources\MedicalRecordResource;
use App\Models\Medicine;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;

class CreateMedicalRecord extends CreateRecord
{
    protected static string $resource = MedicalRecordResource::class;

    /**
     * @throws Halt
     */
    protected function beforeCreate(): void
    {
        foreach ($this->data['prescriptions'] as $prescription){
            if( !Medicine::find($prescription['medicine_id'])->isStockSufficient($prescription['number']) ){
                Notification::make()
                    ->warning()
                    ->title('The stock is insufficient.')
                    ->body('Please make sure the stock available')
                    ->persistent()
                    ->send();

                $this->halt();
            }
        }
    }

}
