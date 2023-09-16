<?php

namespace App\Models;

use App\Filament\Resources\MedicalRecordResource\Enums\ServiceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
      'service_type' => ServiceType::class
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }

    public function advisedPrescriptions(): HasMany
    {
        return $this->hasMany(AdvisedPrescription::class);
    }


    public function labExaminations(): HasMany
    {
        return $this->hasMany(LabExamination::class);
    }

    public function advisedLabExaminations(): HasMany
    {
        return $this->hasMany(AdvisedLabExamination::class);
    }

    public function dentistryTreatment(): HasOne {
        return $this->hasOne(DentistryTreatment::class);
    }

    public function hasPrescriptions(): bool
    {
        return $this->prescriptions !== null;
    }

    public function delete(): ?bool
    {
        $this->prescriptions->each->delete();
        $this->labExaminations->each->delete();
        $this->advisedPrescriptions->each->delete();
        $this->advisedLabExaminations->each->delete();

        return parent::delete();
    }


}

