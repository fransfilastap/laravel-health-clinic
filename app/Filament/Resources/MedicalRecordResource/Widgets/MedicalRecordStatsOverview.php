<?php

namespace App\Filament\Resources\MedicalRecordResource\Widgets;

use App\Filament\Resources\MedicalRecordResource\Enums\ServiceType;
use App\Filament\Resources\MedicalRecordResource\Pages\ListMedicalRecords;
use App\Models\MedicalRecord;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class MedicalRecordStatsOverview extends BaseWidget
{

    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListMedicalRecords::class;
    }

    protected function getStats(): array
    {
        //total per month
        $visitTrend = Trend::model(MedicalRecord::class)
                ->between(
                    start: now()->startOfYear(),
                    end: now()->endOfYear()
                )->perMonth()
            ->count();

        return [
            Stat::make('Trend Kunjungan Total', $this->getPageTableQuery()->count())
                ->chart(
                    $visitTrend
                        ->map(fn (TrendValue $value) => $value->aggregate)
                        ->toArray()
                )->color('danger'),
            Stat::make('Kunjungan Poli Umum', $this->getPageTableQuery()->where('service_type',ServiceType::Medicine)->count()),
            Stat::make('Kunjungan Poli Gigi', $this->getPageTableQuery()->where('service_type',ServiceType::Dentistry)->count()),
        ];
    }

}
