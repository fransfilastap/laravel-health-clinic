<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected function result(): Attribute {
        return Attribute::make(
            get: fn(mixed $value) => sprintf('%d '.$this->lab->unit, $value)
        );
    }

    public function lab(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LabRegistry::class);
    }

    public function medicalRecord(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }


}
