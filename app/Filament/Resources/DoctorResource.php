<?php

namespace App\Filament\Resources;

use App\Actions\User\DoctorAsUser;
use App\Actions\User\DoctorAsUserDTO;
use App\Filament\Resources\DoctorResource\Enums\DoctorType;
use App\Filament\Resources\DoctorResource\Pages;
use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;
    protected static ?string $navigationGroup = 'Personel';
    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema(static::getFormSchemes());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Set as User')
                    ->icon('heroicon-o-user')
                    ->form([
                        Forms\Components\TextInput::make('email')->required(),
                        Forms\Components\Select::make('roles')
                            ->options(Role::query()->pluck('name', 'id'))
                            ->multiple()
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(),
                    ])
                    ->action(function (array $data, Doctor $record, DoctorAsUser $doctorAsUser): void {
                        $doctorAsUser($record, new DoctorAsUserDTO(email: $data['email'], roles: $data['roles'], password: $data['password']));
                    })
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
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('labels.model.doctor');
    }

    public static function getPluralLabel(): ?string
    {
        return __('labels.model.doctor');
    }

    public static function getFormSchemes(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->minLength(5),
            Forms\Components\Select::make('type')
                ->required()
                ->options(DoctorType::class)
        ];
    }
}
