<?php

namespace App\Filament\Resources\DoctorResource\Enums;

use Filament\Support\Contracts\HasLabel;

enum DoctorType: string implements HasLabel
{
    case Medicine = 'MEDICINE';
    case Dentistry = 'DENTISTRY';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Medicine => 'Medicine',
            self::Dentistry => 'Dentistry'
        };
    }
}
