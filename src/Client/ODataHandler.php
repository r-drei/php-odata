<?php

namespace rdrei\odata;

/**
 *  ODataClient class to create OData Querys
 *  @author rdrei <info@r-drei.de>
 */
class ODataHandler
{

    /**
     * @var array
     */
    private $config;

    /**
     * EntityName from the givven ODataHandler
     *
     * @var string
     */
    private $entityName;

    /**
     * ctor
     *
     * @param string $entityName
     * @param array $config
     */
    public function __construct($entityName, $config)
    {
        $this->entityName = $entityName;
        $this->config = $config;
    }

    /**
     * Get request Elements under the criterias that are defined in a ODataQuery 
     * Response
     * @param \rdrei\odata\ODataQuery $query
     * @return mixed
     */
    public function Get($query = null)
    {
        $req = new ODataRequest("GET", $query, $this->config);
        $resp = $req->execute($this->entityName);
        return $resp;
        //return sprintf("%s?%s", $this->getAbsURL(), $query->getURLParameters());
    }

    /**
     * Insert create the givven Element in the OData Endpoint
     *
     * @param string $ressource
     * @return mixed
     */
    public function Insert($body)
    {
        $req = new ODataRequest("POST", null, $this->config);
        $resp = $req->execute($this->entityName, $body);
        return $resp;
    }
    /**
     * Update patch a Element in the OData Endpoint for the givven Key
     *
     * @param string $ressource
     * @return mixed
     */
    public function Update($key, $body)
    {
        $query = new ODataQuery($this->config);
        $query->byKey($key);
        $req = new ODataRequest("PATCH", $query, $this->config);
        $resp = $req->execute($this->entityName, $body);
        return $resp;
    }
    /**
     * Delete remove a Element in the OData Endpoint by Key
     *
     * @param string $ressource
     * @return mixed
     */
    public function Delete($key)
    {
        $query = new ODataQuery($this->config);
        $query->byKey($key);
        $req = new ODataRequest('DELETE', $query, $this->config);
        $resp = $req->execute($this->entityName);
        return $resp;
    }

    private function getAbsURL()
    {
        return sprintf("%s/%s", $this->config['url'], $this->entityName);
    }
}
