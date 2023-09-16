<?php

namespace App\Models;

use App\Filament\Resources\PatientResource\Enums\Education;
use App\Filament\Resources\PatientResource\Enums\Gender;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Patient extends Model
{
    use HasFactory;

    protected $casts = [
        'sex' => Gender::class,
        'education' => Education::class
    ];

    public function medicalRecords(): HasMany{
        return $this->hasMany(MedicalRecord::class);
    }

    public function age(): int
    {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }

}
