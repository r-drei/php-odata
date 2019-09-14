<?php
declare (strict_types = 1);
use PHPUnit\Framework\TestCase;

/**
 * Update_Test
 * Testing CRUD fuctionality
 * @author rdrei <info@r-drei.de>
 */
class Update_Test extends TestCase
{
    const BASE_URL = 'https://services.odata.org/TripPinRESTierService/(S(xuux1chjqcxne5rksvekbvrw))/';
    const ENTITY_NAME = 'Airline';

    public function testODataInsert()
    {
        // Get Client
        $client = new \rdrei\odata\ODataClient(['base_uri' => Update_Test::BASE_URL]);

        // Create Handler & Query
        $entityHandler = $client->CreateHandler(Update_Test::ENTITY_NAME);
        $newAirline = array(
            'AirlineCode' => 'ODATA',
            'Name' => 'ODataFlyAway'
        );
        $reponse = $entityHandler->Update("ODATA", $newAirline);
        // Check if 3 People givven
        //$this->assertNotEmpty($data);
    }
}