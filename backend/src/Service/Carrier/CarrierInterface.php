<?php

namespace App\Service\Carrier;

interface CarrierInterface {

    public function getID(): string;
    public function calculate(float $weightKG): float;
}