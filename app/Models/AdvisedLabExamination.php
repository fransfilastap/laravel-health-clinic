<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdvisedLabExamination extends Model
{
    use HasFactory;

    public function medicalRecord(): BelongsTo {
        return $this->belongsTo(MedicalRecord::class);
    }
}
