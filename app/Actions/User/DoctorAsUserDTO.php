<?php

namespace App\Actions\User;

class DoctorAsUserDTO
{
    public function __construct(public string $email, public array $roles, public string $password){}
}
