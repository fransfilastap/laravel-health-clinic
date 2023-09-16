<?php

namespace App\Models;

use App\Exceptions\NumberOfMedicineExceedStockException;
use App\Filament\Resources\MedicineResource\Enums\DoseType;
use App\Filament\Resources\MedicineResource\Enums\MedicineForms;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Medicine extends Model
{
    use HasFactory;

    protected $casts = [
        'dose_type' => DoseType::class,
        'form' => MedicineForms::class
    ];


    /**
     * @throws NumberOfMedicineExceedStockException
     */
    public function decreaseStock(int $number): void
    {
        if($number > $this->stock){
            throw new NumberOfMedicineExceedStockException();
        }

        $this->update([
            'stock' => $this->stock - $number
        ]);
    }

    public function isStockSufficient(int $stockNeeded):bool{
        return ($this->getAttribute('stock')->stock >= $stockNeeded);
    }
}
