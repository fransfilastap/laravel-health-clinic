<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class AbstractStandardExaminationAttributeCast implements CastsAttributes
{

    protected string $unit = '';
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    final public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value.' '.$this->unit;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    final public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
