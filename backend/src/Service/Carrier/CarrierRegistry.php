<?php

namespace App\Service\Carrier;
use App\Service\Carrier\CarrierInterface;

class CarrierRegistry {
    private array $carriers;

    public function __construct(array $carriers) {
           $this->carriers = $carriers;
    }

    public function getCarriers(): array {
        return $this->carriers;
    }

    public function getCarrier(string $id): CarrierInterface {
        
        foreach ($this->carriers as $carrier) {

            if ($carrier->getId() === $id) {
                return $carrier;
            }
        }

        throw new \InvalidArgumentException('Unsupported carrier');
    }

}