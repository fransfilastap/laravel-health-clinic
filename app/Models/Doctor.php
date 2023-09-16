<?php

namespace App\Models;

use App\Filament\Resources\DoctorResource\Enums\DoctorType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $casts = [
      'type' => DoctorType::class
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isUser(): bool
    {
        return (bool)$this->user();
    }

    public function setAsUser(): void {

    }
}
