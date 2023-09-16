<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescription extends Model
{
    use HasFactory, SoftDeletes;

    public function medicine(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function medicalRecord(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
