<?php

namespace App\Tests\Unit\Carrier;

use PHPUnit\Framework\TestCase;
use App\Service\Carrier\PackGroupCarrier;

class PackGroupTest extends TestCase {

    public function testPrice(): void
    {
        $carrier = new PackGroupCarrier();

        $this->assertEquals(1, $carrier->calculate(1));
        $this->assertEquals(100, $carrier->calculate(100));
    }
}