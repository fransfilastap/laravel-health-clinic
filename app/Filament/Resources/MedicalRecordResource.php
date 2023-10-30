<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Enums\DoctorType;
use App\Filament\Resources\MedicalRecordResource\Enums\ServiceType;
use App\Filament\Resources\MedicalRecordResource\Pages;
use App\Filament\Resources\MedicalRecordResource\RelationManagers;
use App\Filament\Resources\MedicalRecordResource\Widgets\MedicalRecordStatsOverview;
use App\Filament\Resources\PatientResource\Enums\Gender;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Hamcrest\Core\Set;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalRecordResource extends Resource
{
    protected static ?string $model = MedicalRecord::class;
    protected static ?string $navigationGroup = 'Transactions';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                static::getPatientScheme(),
                                static::getDoctorFormScheme()
                            ])->columnSpan(fn(?MedicalRecord $record) => $record === null ? 3 : 1),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn(MedicalRecord $record): ?string => $record->created_at?->diffForHumans()),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn(MedicalRecord $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->columnSpan(['lg' => 1])
                            ->hidden(fn(?MedicalRecord $record) => $record === null)
                    ])->columns(2),
                ...static::getExaminationDetailScheme(),
                static::getMedicalTreatmentScheme(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.name')
                    ->sortable()
                    ->description(
                        fn(MedicalRecord $record): string => sprintf(' ( %d ' . __('labels.common.age_unit') . ')', $record->patient->age()),
                        position: 'below'
                    )
                    ->weight(FontWeight::Bold)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.sex')
                    ->badge()
                    ->label('Gender')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_type')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('complaint'),
                Tables\Columns\TextColumn::make('diagnosis')
                    ->wrap(),
                Tables\Columns\ViewColumn::make('prescriptions')
                    ->view(view: 'tables.columns.prescription-column')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\ViewColumn::make('labExaminations')
                    ->view(view: 'tables.columns.lab-examination-column')
                    ->toggleable()
                    ->toggledHiddenByDefault(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('service_type')
                    ->options(ServiceType::class)
                ,
                Tables\Filters\Filter::make('created_at')->form([
                    DatePicker::make('created_from'),
                    DatePicker::make('created_until'),
                ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->groups([
                Group::make('patient.id')
                    ->label('Nomor Rekam Medis')
                    ->collapsible()
            ])
            ->defaultGroup('patient.id')
            ->defaultSort(column: 'medical_records.created_at', direction: 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()

            ], position: Tables\Enums\ActionsPosition::BeforeCells)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PrescriptionsRelationManager::class,
            RelationManagers\AdvisedPrescriptionsRelationManager::class,
            RelationManagers\LabExaminationsRelationManager::class,
            RelationManagers\AdvisedLabExaminationsRelationManager::class,
            RelationManagers\DentistryTreatmentRelationManager::class,
            /*RelationManagers\PatientRelationManager::class,
            RelationManagers\DoctorRelationManager::class,*/

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicalRecords::route('/'),
            'create' => Pages\CreateMedicalRecord::route('/create'),
            'edit' => Pages\EditMedicalRecord::route('/{record}/edit'),
            'view' => Pages\ViewMedicalRecord::route('/{record}')
        ];
    }

    public static function getDoctorFormScheme(): Forms\Components\Section
    {
        return Forms\Components\Section::make('Doctor')->schema([
            Forms\Components\Select::make('doctor_id')
                ->label(__('labels.model.doctor'))
                ->disabled(fn(string $context) => $context !== 'create')
                ->relationship('doctor', 'name')
                ->searchable()
                ->required(fn(string $context) => $context === 'create')
                ->createOptionForm(DoctorResource::getFormSchemes())
                ->editOptionForm(DoctorResource::getFormSchemes())
                ->afterStateUpdated(function (Forms\Set $set, $state) {
                    $record = Doctor::find($state);
                    if ($record) {
                        $set('service_type', match ($record->type) {
                            DoctorType::Dentistry => ServiceType::Dentistry,
                            DoctorType::Medicine => ServiceType::Medicine
                        });
                    }
                })
                ->afterStateHydrated(function (Forms\Set $set, $state) {
                    $record = Doctor::find($state);
                    if ($record) {
                        $set('service_type', match ($record->type) {
                            DoctorType::Dentistry => ServiceType::Dentistry,
                            DoctorType::Medicine => ServiceType::Medicine
                        });
                    }
                })
                ->reactive(),

            Forms\Components\TextInput::make('service_type')
                ->readOnly()
                ->required(),
        ]);
    }

    public static function getExaminationDetailScheme(): array
    {
        return [
            Forms\Components\Section::make(__('labels.medical_record.standard_examination'))
                ->schema([
                    Forms\Components\Grid::make(['default' => 1, 'md' => 2])
                        ->schema([
                            Forms\Components\Fieldset::make('Keluhan')
                                ->schema([
                                    Forms\Components\Textarea::make('complaint')
                                        ->label(__('labels.medical_record.complaint'))
                                        ->required(),
                                    Forms\Components\Textarea::make('anamnesis')
                                        ->required(),
                                    Forms\Components\Textarea::make('physical_examination')
                                        ->rows(3)
                                        ->label(__('labels.medical_record.physical_examination')),
                                ]),
                            Forms\Components\Fieldset::make('Pemeriksaan Standar')
                                ->schema([
                                    Forms\Components\TextInput::make('blood_pressure')
                                        ->label('Tekanan Darah')
                                        ->numeric()
                                        ->suffix('mmhg')
                                        ->required(),
                                    Forms\Components\TextInput::make('body_temperature')
                                        ->label('Suhu Tubuh')
                                        ->numeric()
                                        ->suffix('C')
                                        ->required(),
                                    Forms\Components\TextInput::make('heart_rate')
                                        ->label('Heart Rate')
                                        ->suffix('kali/menit')
                                        ->numeric()
                                        ->required(),
                                    Forms\Components\TextInput::make('respiration')
                                        ->label('Respirasi')
                                        ->suffix('kali/menit')
                                        ->numeric()
                                        ->required(),
                                    Forms\Components\TextInput::make('saturation')
                                        ->label('Saturation')
                                        ->suffix('%')
                                        ->numeric()
                                        ->required()
                                ])
                        ])
                ]),
            Forms\Components\Section::make(__('labels.medical_record.additional_examination'))
                ->schema([
                    Forms\Components\Repeater::make('lab_examinations')
                        ->label(__('labels.medical_record.lab_examination'))
                        ->required(false)
                        ->hidden(fn(string $context): bool => $context !== 'create')
                        ->relationship('labExaminations')
                        ->schema([
                            Forms\Components\Select::make('lab_id')
                                ->relationship(name: 'lab', titleAttribute: 'name')
                                ->searchable()
                                ->preload()
                                ->createOptionForm(LabRegistryResource::getFormScheme())
                                ->required(),

                            Forms\Components\TextInput::make('result')
                                ->required()
                                ->numeric()
                        ]),
                    Forms\Components\Repeater::make('advisedExaminations')
                        ->label(__('labels.medical_record.advised_lab_examination'))
                        ->required(false)
                        ->hidden(fn(string $context): bool => in_array($context, ['edit', 'view']))
                        ->relationship('advisedLabExaminations')
                        ->schema([
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('result'),
                        ])
                ]),
        ];
    }

    public static function getPatientScheme(): Forms\Components\Component
    {
        return
            Forms\Components\Section::make('Patient')
                ->label(__('labels.model.patient'))
                ->schema([
                    Forms\Components\Select::make('patient_id')
                        ->disabled(fn(string $context) => $context !== 'create')
                        ->relationship('patient', 'name')
                        ->searchable()
                        ->required(fn(string $context) => $context === 'create')
                        ->createOptionForm(PatientResource::getFormScheme())
                        ->editOptionForm(PatientResource::getFormScheme())
                        ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                            $record = Patient::find($get('patient_id'));
                            $set('patient_name', $record->name);
                            $set('date_of_birth', $record->date_of_birth);
                            $set('age', $record->age());
                        })
                        ->afterStateHydrated(function ($state, Forms\Set $set, Forms\Get $get) {
                            if ($get('patient_id')) {
                                $record = Patient::find($get('patient_id'));
                                $set('patient_name', $record->name);
                                $set('date_of_birth', $record->date_of_birth);
                                $set('age', $record->age());
                            }
                        })
                        ->reactive(),
                    Forms\Components\Fieldset::make('Patient Details')
                        ->schema([
                            Forms\Components\TextInput::make('patient_name')->disabled(),
                            Forms\Components\DatePicker::make('date_of_birth')->disabled(),
                            Forms\Components\TextInput::make('age')->disabled()
                        ])
                ]);
    }

    public static function getMedicalTreatmentScheme(): Forms\Components\Component
    {
        return
            Forms\Components\Section::make(__('labels.medical_record.medical_treatment'))
                ->schema([
                    Forms\Components\Textarea::make('diagnosis')
                        ->required(),
                    Forms\Components\Group::make()
                        ->relationship('dentistryTreatment')
                        ->hidden(fn(Forms\Get $get) => Doctor::find($get('doctor_id'))?->type != DoctorType::Dentistry)
                        ->schema([
                            Forms\Components\Textarea::make('treatment')
                                ->label(__('labels.medical_record.dentistry_treatment'))
                                ->required()
                        ]),
                    Forms\Components\Grid::make()
                        ->hidden(fn(string $context): bool => $context !== 'create')
                        ->schema([
                            Forms\Components\Repeater::make("prescriptions")
                                ->label(__('labels.medical_record.prescription'))
                                ->hidden(fn(string $context): bool => $context == 'edit')
                                ->relationship('prescriptions')
                                ->schema([
                                    Forms\Components\Select::make('medicine_id')
                                        ->searchable()
                                        ->relationship(name: 'medicine', titleAttribute: 'name_with_dose')
                                        ->required(),
                                    Forms\Components\TextInput::make('number')
                                        ->label('Quantity')
                                        ->numeric()
                                        ->maxValue(fn(Forms\Get $get) => Medicine::find($get('medicine_id'))->stock ?? -1)
                                        ->required(),
                                    Forms\Components\Textarea::make('instruction')
                                ]),
                            Forms\Components\Repeater::make('advisedPrescriptions')
                                ->label(__('labels.medical_record.advised_prescription'))
                                ->required(false)
                                ->hidden(fn(string $context): bool => $context == 'edit')
                                ->relationship('advisedPrescriptions')
                                ->schema([
                                    Forms\Components\TextInput::make('medicine_name')->required(),
                                    Forms\Components\TextInput::make('dose')->required(),
                                    Forms\Components\TextInput::make('unit')->required(),
                                    Forms\Components\Textarea::make('instruction')->required()
                                ])
                        ])
                    ,
                ]);
    }

    public static function getWidgets(): array
    {
        return [
            MedicalRecordStatsOverview::class
        ];
    }
}
