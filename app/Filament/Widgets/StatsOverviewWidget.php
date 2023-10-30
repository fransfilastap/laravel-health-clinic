<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PatientResource\Pages\ListPatients;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Patient;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{

    protected function getStats(): array
    {
        return [
            Stat::make(__('labels.model.patient') . ' ', Patient::query()->count())
                ->description('Number of Patients registered'),
            Stat::make(__('labels.model.visit'), MedicalRecord::query()->count())
                ->description('Number of examinations conducted'),
            Stat::make(__('labels.model.medicine'), Medicine::query()->count())
                ->description('Number of medicine type registered.')
        ];
    }


}
