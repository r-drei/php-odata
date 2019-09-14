<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Insert_Test
 * Testing CRUD fuctionality
 * @author rdrei <info@r-drei.de>
 */
class Insert_Test extends TestCase
{
    const BASE_URL = 'https://services.odata.org/v4/(S(vuvl2lo1td4r1lzfpne2zqlz))/TripPinServiceRW/';
    const ENTITY_NAME = 'Airlines';

    public function testODataInsert()
    {
        // Get Client
        $client = new \rdrei\odata\ODataClient(['base_uri' => Insert_Test::BASE_URL]);

        // Create Handler & Query
        $entityHandler = $client->CreateHandler(Insert_Test::ENTITY_NAME);
        $testAirline = array(
            'AirlineCode' => 'foobar',
            'Name' => 'foobar Airline',
        );
        $reponse = $entityHandler->Insert($testAirline);

        // Check if Created  
        $this->assertNotEmpty($reponse);
    }
}
