<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicineResource\Pages;
use App\Filament\Resources\MedicineResource\RelationManagers;
use App\Filament\Resources\MedicineResource\Enums\DoseType;
use App\Filament\Resources\MedicineResource\Enums\MedicineForms;
use App\Filament\Resources\MedicineResource\Enums\MedicineUnit;
use App\Models\Medicine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PHPUnit\Util\Filter;

class MedicineResource extends Resource
{
    protected static ?string $model = Medicine::class;
    protected static ?string $navigationGroup = 'Services';
    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\Select::make('form')
                            ->options(MedicineForms::class),
                        Forms\Components\Select::make('dose_type')
                            ->required()
                            ->options(DoseType::class),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('dose')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\Select::make('unit')
                                    ->required()
                                    ->options(MedicineUnit::class)
                            ])
                    ]),
                Forms\Components\Section::make('Stock Information')
                    ->schema([
                        Forms\Components\TextInput::make('stock')
                            ->label('Initial Stock')
                            ->required()
                            ->default(0)
                            ->numeric()
                    ])
            ]);
    }

    public static function getLabel(): ?string
    {
        return __('labels.model.medicine');
    }

    public static function getPluralLabel(): ?string
    {
        return __('labels.model.medicine');
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight(FontWeight::Medium),
                Tables\Columns\TextColumn::make('form'),
                Tables\Columns\TextColumn::make('dose')->state(fn(Medicine $record)=> $record->dose.' '.$record->unit),
                Tables\Columns\TextColumn::make('dose_type'),
                Tables\Columns\TextColumn::make('stock')
                    ->searchable()
            ])
            ->filters([
                Tables\Filters\Filter::make('name'),
                Tables\Filters\SelectFilter::make('form')
                    ->options(MedicineForms::class)
                    ->multiple(),
                Tables\Filters\Filter::make('dose'),
                Tables\Filters\SelectFilter::make('dose_type')
                    ->multiple()
                    ->options(DoseType::class)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicines::route('/'),
            'create' => Pages\CreateMedicine::route('/create'),
            'edit' => Pages\EditMedicine::route('/{record}/edit'),
        ];
    }
}
