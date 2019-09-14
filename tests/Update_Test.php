<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Update_Test
 * Testing CRUD fuctionality
 * @author rdrei <info@r-drei.de>
 */
class Update_Test extends TestCase
{
    const BASE_URL = 'https://services.odata.org/v4/(S(vuvl2lo1td4r1lzfpne2zqlz))/TripPinServiceRW/';
    const ENTITY_NAME = 'Airlines';

    public function testODataUpdate()
    {
        // Get Client
        $client = new \rdrei\odata\ODataClient(['base_uri' => Update_Test::BASE_URL]);

        // Create Handler & Query
        $entityHandler = $client->CreateHandler(Update_Test::ENTITY_NAME);
        $testAirline = array(
            'AirlineCode' => 'foobar',
            'Name' => 'foobar Airline',
        );
        $entityHandler->Insert($testAirline);

        $testAirline["Name"] = "the foobar Airlines";
        $reponse = $entityHandler->Update('foobar', $testAirline);

        // Check no error 
        $this->assertEmpty($reponse);
    }
}
