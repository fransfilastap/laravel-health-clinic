<?php

namespace App\Livewire\Patients;

use App\Filament\Resources\PatientResource\Enums\Gender;
use App\Models\Patient;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListPatients extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function form(Form $form): Form
    {
        return $form->schema([
            Hidden::make('patient_id')
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Patient::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sex')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('social_number')
                    ->searchable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sex')
                    ->options(Gender::class)
            ])
            ->actions([
                Tables\Actions\Action::make('Pick')
                    ->action(function (Patient $record,array &$data){
                        $data['patient_id'] =  $record->id;
                    })
            ]);
    }

    public function render(): View
    {
        return view('livewire.patients.list-patients');
    }
}
