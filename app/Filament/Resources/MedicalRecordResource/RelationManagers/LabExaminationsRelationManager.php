<?php

namespace App\Filament\Resources\MedicalRecordResource\RelationManagers;

use App\Filament\Resources\LabRegistryResource;
use App\Models\LabRegistry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabExaminationsRelationManager extends RelationManager
{
    protected static string $relationship = 'labExaminations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lab_id')
                    ->searchable()
                    ->preload()
                    ->getSearchResultsUsing(fn(string $query) => LabRegistry::where('name', 'like', "%{$query}%")->pluck('name', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => LabRegistry::find($value)->getAttribute('name'))
                    ->createOptionForm(LabRegistryResource::getFormScheme())
                ,
                Forms\Components\TextInput::make('result')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('lab.name'),
                Tables\Columns\TextColumn::make('result'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
}
