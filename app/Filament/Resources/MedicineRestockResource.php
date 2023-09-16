<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicineRestockResource\Pages;
use App\Filament\Resources\MedicineRestockResource\RelationManagers;
use App\Models\MedicineRestock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicineRestockResource extends Resource
{
    protected static ?string $model = MedicineRestock::class;
    protected static ?string $navigationGroup = 'Transactions';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListMedicineRestocks::route('/'),
            'create' => Pages\CreateMedicineRestock::route('/create'),
            'view' => Pages\ViewMedicineRestock::route('/{record}'),
            'edit' => Pages\EditMedicineRestock::route('/{record}/edit'),
        ];
    }
}
