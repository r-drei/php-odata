<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Delete_Test
 * Testing CRUD fuctionality
 * @author rdrei <info@r-drei.de>
 */
class Delete_Test extends TestCase
{
    const BASE_URL = 'https://services.odata.org/v4/(S(vuvl2lo1td4r1lzfpne2zqlz))/TripPinServiceRW/';
    const ENTITY_NAME = 'Airlines';

    public function testODataDelete()
    {
        // Get Client
        $client = new \rdrei\odata\ODataClient(['base_uri' => Delete_Test::BASE_URL]);

        // Create Handler & Query
        $entityHandler = $client->CreateHandler(Delete_Test::ENTITY_NAME);
        $testAirline = array(
            'AirlineCode' => 'foobar',
            'Name' => 'foobar Airline',
        );

        $entityHandler->Insert($testAirline);
        $reponse = $entityHandler->Delete($testAirline["AirlineCode"]);

        // Check no error 
        $this->assertEmpty($reponse);
    }
}
