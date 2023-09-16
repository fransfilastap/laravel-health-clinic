<?php

namespace App\Filament\Resources\MedicalRecordResource\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ServiceType: string implements HasLabel, HasColor
{

    case Medicine = 'Medicine';
    case Dentistry = 'Dentistry';

    public function getLabel(): ?string
    {
        return match ($this){
            self::Dentistry => 'Dentistry',
            self::Medicine => 'Medicine'
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this){
            self::Dentistry => 'gray',
            self::Medicine => 'warning'
        };
    }
}
