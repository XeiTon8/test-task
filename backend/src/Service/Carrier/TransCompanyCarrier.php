<?php

namespace App\Service\Carrier;

use App\Service\Carrier\CarrierInterface;

class TransCompanyCarrier implements CarrierInterface {

    public function calculate(float $weightKG): float
    {
        if ($weightKG <= 10) return 20;
       
        return 100;
    }

    public function getID(): string
    {
        return 'transcompany';
    }
}