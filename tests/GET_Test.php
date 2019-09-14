<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Get_Test
 * Testing CRUD fuctionality
 * @author rdrei <info@r-drei.de>
 */
class Get_Test extends TestCase
{
    const BASE_URL = 'https://services.odata.org/TripPinRESTierService/';
    const ENTITY_NAME = 'Airports';
    const ENTITY_TEST_COUNT = 3;
    const ENTITY_KEY = 'KLAX';
    const ENTITY_TEST_NAME = 'Los Angeles International Airport';
    const ENTITY_FILTER = 'indexof(Name, \'Los Angeles\') gt -1';
    const ENTITY_TEST_FILTER_COUNT = 1;

    public function testODataGet()
    {
        // Get Client
        $client = new \rdrei\odata\ODataClient(['base_uri' => Get_Test::BASE_URL]);

        // Create Handler & Query
        $entityHandler = $client->CreateHandler(Get_Test::ENTITY_NAME);
        $reponse = $entityHandler->Get();

        //stdClass for OData Collection Response
        $data = $reponse->value;
        // Check if 3 People givven
        $this->assertNotEmpty($data);
    }


    public function testODataGetPaged()
    {
        // Get Client
        $client = new \rdrei\odata\ODataClient(['base_uri' => Get_Test::BASE_URL]);

        // Create Handler & Query
        $entityHandler = $client->CreateHandler(Get_Test::ENTITY_NAME);
        $query = $client->CreateQuery();

        // Build Query
        $query = $query->skip(0)->take(Get_Test::ENTITY_TEST_COUNT); // Throw in refAPI an exception ->Count();

        // Execute Handler with Query
        $reponse = $entityHandler->Get($query);

        //stdClass for OData Collection Response
        $data = $reponse->value;
        // Check if 3 People givven
        $this->assertCount(Get_Test::ENTITY_TEST_COUNT, $data);
    }

    public function testODataGetByKey()
    {
        $client = new \rdrei\odata\ODataClient(['base_uri' => Get_Test::BASE_URL]);
        $entityHandler = $client->CreateHandler(Get_Test::ENTITY_NAME);
        $query = $client->CreateQuery();
        $query = $query->byKey(Get_Test::ENTITY_KEY); // Look at APIs $metadata for the Key Propertie;

        // Execute Handler with Query
        $reponse = $entityHandler->Get($query);

        // stdClass for OData Entity
        $airportName = $reponse->Name;
        $airportIcaoCode = $reponse->IcaoCode; //IcaoCode is the Key property in Airports Entity

        // Check if founded Airport matches...
        $this->assertEquals(Get_Test::ENTITY_KEY, $airportIcaoCode);
        $this->assertEquals(Get_Test::ENTITY_TEST_NAME, $airportName);
    }

    public function testODataGetWithFilter()
    {
        $client = new \rdrei\odata\ODataClient(['base_uri' => Get_Test::BASE_URL]);
        $entityHandler = $client->CreateHandler(Get_Test::ENTITY_NAME);
        $query = $client->CreateQuery();
        $query = $query->filter(Get_Test::ENTITY_FILTER); // Look at APIs $metadata for the Key Propertie;

        // Execute Handler with Query
        $reponse = $entityHandler->Get($query);

        //stdClass for OData Collection Response
        $data = $reponse->value;

        // Check if 1 Airport is givven
        $this->assertCount(Get_Test::ENTITY_TEST_FILTER_COUNT, $data);

        foreach ($data as $key => $obj) {
            $this->assertContains('Los Angeles', $obj->Name);
        }
    }
}
