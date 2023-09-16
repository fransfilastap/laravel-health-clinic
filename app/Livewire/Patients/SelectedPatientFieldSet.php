<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class SelectedPatientFieldSet extends Component implements HasForms
{
    use InteractsWithForms;

    public Patient $patient;

    public function mount(Patient $patient):void{
        $this->form->fill($patient->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
                ->schema([
                    Fieldset::make('Patient Details')
                        ->schema([
                            TextInput::make('name')
                                ->disabled()
                        ])
                ]);
    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.patients.selected-patient-field-set');
    }
}
