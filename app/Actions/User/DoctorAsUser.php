<?php

namespace App\Actions\User;

use App\Models\Doctor;
use App\Models\User;

class DoctorAsUser
{
    public function __invoke(Doctor $doctor, DoctorAsUserDTO $asUserDTO): void
    {
        $user = User::create([
            'name' => $doctor->getAttribute('name'),
            'email' => $asUserDTO->email,
            'password' => $asUserDTO->password,
        ]);

        foreach ($asUserDTO->roles as $role){
            $user->assignRole($role);
        }
    }
}
