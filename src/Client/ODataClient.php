<?php namespace rdrei\odata;

/**
 *  ODataClient class to create OData Querys
 *  @author rdrei <info@r-drei.de>
 */
class ODataClient
{

      /**
       * @var array
       */
      private $config;

      /**
       * Constructor
       *
       * @param array $config
       */
      public function __construct($config = [])
      {
            $this->config = $config;
      }

      /**
       * Creates a ODataHandler with givven OData Entity
       * @param string $entityName
       * @return \rdrei\odata\ODataHandler
       */
      public function CreateHandler($entityName)
      {
            return new ODataHandler($entityName, $this->config);
      }

      /**
       * Creates a new ODataQuery
       * @return \rdrei\odata\ODataQuery
       */
      public function CreateQuery()
      {
            return new ODataQuery($this->config);
      }
}
