<?php

namespace App\Models;

use App\Casts\BloodPressure;
use App\Filament\Resources\MedicalRecordResource\Enums\ServiceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'service_type' => ServiceType::class,
        /*'blood_pressure' => BloodPressure::class*/
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

    public function dentistryTreatment(): HasOne
    {
        return $this->hasOne(DentistryTreatment::class);
    }

    public function hasPrescriptions(): bool
    {
        return !($this->prescriptions === null);
    }

    public function delete(): ?bool
    {
        if (!empty($this->prescriptions)) {
            $this->prescriptions->each->delete();
        }
        if (!empty($this->labExaminations)) {
            $this->labExaminations->each->delete();
        }
        if (!empty($this->advisedPrescriptions)) {
            $this->advisedPrescriptions->each->delete();
        }
        if (!empty($this->advisedLabExaminations)) {
            $this->advisedLabExaminations->each->delete();
        }

        return parent::delete();
    }

}

