<?php

namespace App\Service\Carrier;

use App\Service\Carrier\CarrierInterface;

class PackGroupCarrier implements CarrierInterface {

    public function calculate(float $weightKG): float
    {
       return $weightKG * 1;
    }

    public function getID(): string
    {
        return "packgroup";
    }

}