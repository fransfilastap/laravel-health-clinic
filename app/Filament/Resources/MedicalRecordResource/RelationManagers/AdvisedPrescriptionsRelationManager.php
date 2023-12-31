<?php

namespace App\Filament\Resources\MedicalRecordResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdvisedPrescriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'advisedPrescriptions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('medicine_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('dose')
                    ->required(),
                Forms\Components\TextInput::make('unit')
                    ->required()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('medicine_name')
            ->columns([
                Tables\Columns\TextColumn::make('medicine_name'),
                Tables\Columns\TextColumn::make('dose'),
                Tables\Columns\TextColumn::make('unit')
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
