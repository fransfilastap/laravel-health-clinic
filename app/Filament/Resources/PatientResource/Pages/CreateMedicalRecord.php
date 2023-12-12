<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use App\Models\Patient;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class CreateMedicalRecord extends Page
{
    use InteractsWithRecord;

    protected static string $resource = PatientResource::class;

    protected static string $view = 'filament.resources.patient-resource.pages.create-medical-record';

    public function mount(Patient $record): void
    {
        $this->record = $record;
        static::authorizeResourceAccess();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Patient Details')
                ->schema([
                    Fieldset::make('Patient Details')
                        ->schema([
                            TextInput::make('patient_name')->disabled(),
                            DatePicker::make('date_of_birth')->disabled(),
                            TextInput::make('age')->disabled(),
                            Textarea::make('allergic')->disabled()
                        ])
                ])
        ]);
    }
}
