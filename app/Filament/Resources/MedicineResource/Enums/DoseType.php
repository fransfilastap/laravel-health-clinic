<?php

namespace App\Filament\Resources\MedicineResource\Enums;

use Filament\Support\Contracts\HasLabel;

enum DoseType: string implements HasLabel
{
    case Default = 'Default';
    case Mixed = 'Mixed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Default => 'Default',
            self::Mixed => 'Mixed'
        };
    }
}
