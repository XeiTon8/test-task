<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Service\Calculator;
use App\Service\Carrier\CarrierRegistry;
use App\Service\Carrier\TransCompanyCarrier;
use App\Service\Carrier\PackGroupCarrier;

class CalculatorTest extends TestCase {

    public function testCalculation(): void {

        $registry = new CarrierRegistry([
            new TransCompanyCarrier(),
            new PackGroupCarrier()
        ]);

        $calculator = new Calculator($registry);

        $this->assertEquals(100, $calculator->calculate('transcompany',15));
        $this->assertEquals(135, $calculator->calculate('packgroup', 135));
    }

    public function testError(): void {

       $registry = new CarrierRegistry([]);
       $calculator = new Calculator($registry);

       $this->expectException(\InvalidArgumentException::class);

       $calculator->calculate('test',25);

    }
 
}