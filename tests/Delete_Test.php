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
    const BASE_URL = 'https://services.odata.org/TripPinRESTierService/';
    const ENTITY_NAME = 'Airline';

    public function testODataInsert()
    {
        // Get Client
        $client = new \rdrei\odata\ODataClient(['base_uri' => Delete_Test::BASE_URL]);

        // Create Handler & Query
        $entityHandler = $client->CreateHandler(Delete_Test::ENTITY_NAME);
        $reponse = $entityHandler->Delete("ODATA");
        // Check if 3 People givven
        //$this->assertNotEmpty($data);
    }
}
