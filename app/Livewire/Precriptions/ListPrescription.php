<?php

namespace App\Livewire\Precriptions;

use App\Models\MedicalRecord;
use App\Models\Prescription;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Support\Contracts\TranslatableContentDriver;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ListPrescription extends Component implements HasInfolists, HasForms
{
    use InteractsWithForms,InteractsWithInfolists;
    public Prescription $prescription;

    public function mount(Prescription $prescription): void
    {
        $this->prescription = $prescription;
    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.precriptions.list-prescription');
    }

    public function prescriptionInfoLists(Infolist $infolist): Infolist{
        return $infolist
            ->record($this->prescription)
            ->schema([
               TextEntry::make('medicine.name'),
                TextEntry::make('medicine.dose'),
                TextEntry::make('number')
            ]);
    }
}
