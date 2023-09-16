<?php

namespace App\Filament\Resources\MedicineResource\Enums;

use Filament\Support\Contracts\HasLabel;

enum MedicineForms: string implements HasLabel
{
    case Solid = 'solid';
    case Liquid = 'liquid';
    case Cream = 'cream';
    case Gel = 'gel';
    case  Tablet = 'tablet';
    case Syrup = 'syrup';
    case Ampoule = 'ampoule';
    case Flask = 'flask';
    case Capsule = 'kapsul';


    public function getLabel(): ?string
    {
        return match ($this){
            self::Solid => 'Solid',
            self::Capsule => 'Capsule',
            self::Liquid => 'Liquid',
            self::Cream => 'Cream',
            self::Gel => 'Gel',
            self::Tablet => 'Tablet',
            self::Syrup => 'Syrup',
            self::Ampoule => 'Ampoule',
            self::Flask => 'Flask'
        };
    }
}
