<?php

namespace App\Filament\Resources\MedicineResource\Enums;

use Filament\Support\Contracts\HasLabel;

enum MedicineUnit: string implements HasLabel
{

    case Gram = 'g';
    case Milligram = 'mg';
    case Microgram = 'mcg';
    case InternationalUnits = 'IU';
    case MilligramPer5milliliter = 'mg/5ml';

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
