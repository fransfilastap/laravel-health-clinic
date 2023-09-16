<?php

namespace App\Filament\Resources\PatientResource\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Gender: string implements HasLabel, HasColor
{
    case Male = 'MALE';
    case Female = 'FEMALE';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Male => 'Male',
            self::Female => 'Female'
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Male => 'success',
            self::Female => 'gray'
        };
    }
}
