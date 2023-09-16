<?php

namespace App\Filament\Resources\MedicalRecordResource\RelationManagers;

use App\Models\Medicine;
use App\Models\Prescription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrescriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'prescriptions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('medicine_id')
                    ->label('Medicine')
                    ->searchable()
                    ->getSearchResultsUsing(fn(string $query) => Medicine::where('name', 'like', "%{$query}%")->pluck('name', 'id'))
                    ->getOptionLabelUsing(fn($value): ?string => Medicine::find($value)->getAttribute('name')),
                Forms\Components\TextInput::make('number')
                    ->required(),
                Forms\Components\Textarea::make('instruction')->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('medicine.name')
                    ->weight(FontWeight::Bold)
                ->description(fn(Prescription $record):string => $record->medicine->dose)
                    ,
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\TextColumn::make('instruction')
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
