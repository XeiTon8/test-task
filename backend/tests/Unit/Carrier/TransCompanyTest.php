<?php

namespace App\Tests\Unit\Carrier;

use PHPUnit\Framework\TestCase;
use App\Service\Carrier\TransCompanyCarrier;

class TransCompanyTest extends TestCase {
    public function testPriceForWeightLessOrEqual10(): void
    {
        $carrier = new TransCompanyCarrier();
        
        $this->assertEquals(20, $carrier->calculate(10));
    }

    public function testPriceForWeightGreaterThan10(): void
    {
        $carrier = new TransCompanyCarrier();

        $this->assertEquals(100, $carrier->calculate(11));
        $this->assertEquals(100, $carrier->calculate(50));
    }
}