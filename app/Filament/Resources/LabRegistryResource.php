<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabRegistryResource\Enums\LabUnit;
use App\Filament\Resources\LabRegistryResource\Pages;
use App\Filament\Resources\LabRegistryResource\RelationManagers;
use App\Models\LabRegistry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LabRegistryResource extends Resource
{
    protected static ?string $model = LabRegistry::class;
    protected static ?string $navigationGroup = 'Services';

    protected static ?string $navigationIcon = 'heroicon-o-eye-dropper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormScheme());
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit'),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
            ])
            ->filters([
                Tables\Filters\Filter::make('name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListLabRegistries::route('/'),
            'create' => Pages\CreateLabRegistry::route('/create'),
            'edit' => Pages\EditLabRegistry::route('/{record}/edit'),
        ];
    }

    public static function getFormScheme(): array {
        return [
            Forms\Components\Section::make('Lab Information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->minLength(10),
                    Forms\Components\Select::make('unit')
                        ->required()
                        ->default(LabUnit::MG_DL)
                        ->options(LabUnit::class),
                    Forms\Components\Textarea::make('description')
                        ->required()
                        ->rows(10)
                ])
        ];
    }
}
