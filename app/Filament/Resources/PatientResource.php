<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Enums\Education;
use App\Filament\Resources\PatientResource\Enums\Gender;
use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Filament\Widgets\StatsOverviewWidget;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;
    protected static ?string $navigationGroup = 'Services';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = "name";


    public static function form(Form $form): Form
    {
        return $form->schema(static::getFormScheme());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->description(fn(Patient $record):string=> sprintf('%d ('.__('labels.common.age_unit').')',$record->age()))
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
                Tables\Actions\Action::make('new medical record')
                    ->url(fn (Patient $record) : string => route('filament.admin.resources.patients.mr',['record'=>$record]))
                    ->icon('heroicon-o-document-plus'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
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
            RelationManagers\MedicalRecordsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'mr' => Pages\CreateMedicalRecord::route('/{record}/create-mr'),
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'view' => Pages\ViewPatient::route('/{record}'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }

    public static function getFormScheme(): array
    {
        return [
            Forms\Components\Section::make('Patient\'s Identity')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('date_of_birth')
                        ->required()
                        ->maxDate(now()),
                    Forms\Components\Select::make('sex')
                        ->options(Gender::class)
                        ->required(),
                    Forms\Components\Textarea::make('address')
                        ->rows(5)
                        ->required(),
                    Forms\Components\Select::make('education')
                        ->options(Education::class),
                ]),

            Forms\Components\Section::make('Additional Information')
                ->schema([
                    Forms\Components\TextInput::make('social_number'),
                    Forms\Components\TextInput::make('mobile_phone'),
                ]),

            Forms\Components\Section::make('Notes')
                ->schema([
                    Forms\Components\Textarea::make('allergic')
                ])
        ];
    }

    public static function getWidgets(): array
    {
        return [
          StatsOverviewWidget::class
        ];
    }



}
