<?php

namespace App\Observers;

use App\Models\Prescription;

class PrescriptionObserver
{
    /**
     * Handle the Prescription "created" event.
     */
    public function created(Prescription $prescription): void
    {
        if(!env('MIGRATION')){
            $prescription->medicine->decreaseStock($prescription->getAttribute('number'));
        }
    }

    /**
     * Handle the Prescription "updated" event.
     */
    public function updated(Prescription $prescription): void
    {
        //
    }

    /**
     * Handle the Prescription "deleted" event.
     */
    public function deleted(Prescription $prescription): void
    {
        //
    }

    /**
     * Handle the Prescription "restored" event.
     */
    public function restored(Prescription $prescription): void
    {
        //
    }

    /**
     * Handle the Prescription "force deleted" event.
     */
    public function forceDeleted(Prescription $prescription): void
    {
        //
    }
}
