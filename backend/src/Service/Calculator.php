<?php

namespace App\Service;

use App\Service\Carrier\CarrierRegistry;

class Calculator {
    private CarrierRegistry $carrierRegistry;
    public function __construct( CarrierRegistry $carrierRegistry) { 
        $this->carrierRegistry = $carrierRegistry;
    }

    public function calculate(string $id, float $weightKG): float {
        
         $carrier = $this->carrierRegistry->getCarrier($id);

         return $carrier->calculate($weightKG);
     }
}