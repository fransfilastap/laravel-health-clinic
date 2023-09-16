<?php

namespace App\Filament\Resources\MedicalRecordResource\Pages;

use App\Filament\Resources\MedicalRecordResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListMedicalRecords extends ListRecords
{

    use ExposesTableToWidgets;

    protected static string $resource = MedicalRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return MedicalRecordResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => ListRecords\Tab::make('All'),
            'medicine' => ListRecords\Tab::make()->query(fn($query) => $query->where('service_type', MedicalRecordResource\Enums\ServiceType::Medicine)),
            'dentistry' => ListRecords\Tab::make()->query(fn($query) => $query->where('service_type', MedicalRecordResource\Enums\ServiceType::Dentistry))
        ];
    }

}
