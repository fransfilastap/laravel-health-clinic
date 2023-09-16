<?php

namespace App\Console\Commands;

use App\Models\LabExamination;
use App\Models\LabRegistry;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Prescription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate medical record of legacy system database to new system';

    const SEPARATOR = ';';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {


        if( $this->confirm('You\'re about to migrate your legacy medical record data to new system. Do you wish to continue?') ){
            DB::transaction(function (){
                MedicalRecord::withoutTrashed()->whereNotNull('legacy_id')->each(function (MedicalRecord $medicalRecord){
                    if($legacyPrescriptions = $medicalRecord->getAttribute('legacy_prescriptions')){
                        $arrLegacyPrescriptions = explode(self::SEPARATOR, $legacyPrescriptions);
                        $medicines = explode('|',$arrLegacyPrescriptions[0]);
                        $quantities = explode('|',$arrLegacyPrescriptions[1]);
                        $usage = explode('|',$arrLegacyPrescriptions[2]);

                        $this->info(sprintf('Migrating mrid %s, patient name %s', $medicalRecord->id, $medicalRecord->patient->name));

                        foreach ($medicines as $row => $medicine){
                            $eloquentMedicine = Medicine::query()->where('legacy_id',$medicine)->first();
                            if($eloquentMedicine!=null){
                                $data = [
                                    'medical_record_id' => $medicalRecord->id,
                                    'medicine_id' => $eloquentMedicine->id,
                                    'number' => $quantities[$row],
                                    'instruction' => $usage[$row],
                                    'created_at' => $medicalRecord->created_at,
                                    'updated_at' => $medicalRecord->updated_at
                                ];
                                $this->info(sprintf('   Insert precription %s , qty %d', $eloquentMedicine->name, $quantities[$row]));
                                Prescription::create($data);
                                $this->info(sprintf('   Insert precription %s, qty %d done', $eloquentMedicine->name, $quantities[$row]));
                            }
                        }
                    }

                    if( $legacyLabExaminations = $medicalRecord->getAttribute('legacy_lab_examinations') ){
                        $arrLegacyLabExaminations = explode(self::SEPARATOR, $legacyLabExaminations);
                        $labRegistries = explode('|', $arrLegacyLabExaminations[0]);
                        $labResults = explode('|', $arrLegacyLabExaminations[1]);

                        foreach ($labRegistries as $row => $labRegistry){
                            $eloquentLabRegistry = LabRegistry::query()->where('legacy_id', $labRegistry)->first();
                            if(!is_null($eloquentLabRegistry)){
                                $data = [
                                    'medical_record_id' => $medicalRecord->id,
                                    'lab_id' => $eloquentLabRegistry->id,
                                    'result' => $labResults[$row],
                                    'created_at' => $medicalRecord->created_at,
                                    'updated_at' => $medicalRecord->updated_at
                                ];
                                LabExamination::create($data);
                            }
                        }
                    }
                });
            });
        }


    }
}
