<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class BloodPressure extends AbstractStandardExaminationAttributeCast
{
    protected string $unit = 'mmhg';
}
