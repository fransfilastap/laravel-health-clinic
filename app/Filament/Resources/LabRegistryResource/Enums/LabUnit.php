<?php

namespace App\Filament\Resources\LabRegistryResource\Enums;

use Filament\Support\Contracts\HasLabel;

enum LabUnit: string implements HasLabel
{

    case MG_DL = 'mg/dl';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::MG_DL => 'mg/dl'
        };
    }
}
