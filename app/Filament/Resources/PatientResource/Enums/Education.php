<?php

namespace App\Filament\Resources\PatientResource\Enums;

use Filament\Support\Contracts\HasLabel;

enum Education: string implements HasLabel
{

    case SD = 'SD';
    case SMP = 'SMP';
    case SMA = 'SMA';
    case TidakSekolah = 'Tidak Sekolah';
    case PerguruanTinggi = 'Perguruan Tinggi';


    public function getLabel(): ?string
    {
        return match ($this){
            self::SD => 'SD',
            self::SMP => 'SMP',
            self::SMA => 'SMA',
            self::PerguruanTinggi => 'Perguruan Tinggi',
            self::TidakSekolah => 'Tidak Sekolah',
        };
    }
}
