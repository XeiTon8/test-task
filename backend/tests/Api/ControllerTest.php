<?php

namespace App\Tests\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTest extends WebTestCase {

    public function testSuccess() {
        $client = static::createClient();

        $client->request("POST","/api/shipping/calculate", 
            [], [], 
            ["CONTENT_TYPE"=> "application/json"], 
            json_encode([
                'carrier' => 'transcompany',
                'weightKG' => 12
            ])
        );

        $this->assertResponseIsSuccessful();

        $res = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('100', $res['price']);
        $this->assertEquals('EUR', $res['currency']);
    }

    public function testFailure() { 
        $client = static::createClient();

        $client->request("POST","/api/shipping/calculate", 
            [], [], 
            ["CONTENT_TYPE"=> "application/json"], 
            json_encode([
                'carrier' => 'unknown',
                'weightKG' => 14
            ])
        );

        $this->assertResponseStatusCodeSame(400);
    }
}