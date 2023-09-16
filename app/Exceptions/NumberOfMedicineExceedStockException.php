<?php

namespace App\Exceptions;

class NumberOfMedicineExceedStockException extends BaseException
{

    public function __construct()
    {
        parent::__construct("Number of medicine in prescription exceed stock number");
    }

    public function report(): void
    {

    }
}
