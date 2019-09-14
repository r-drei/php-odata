<?php namespace rdrei\odata;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;
use TheSeer\Tokenizer\Exception;

/**
 *  ODataClient class to create OData Querys
 *  @author rdrei <info@r-drei.de>
 */
class ODataRequest
{

    /**
     * @var array
     */
    private $config;
    private $query;
    private $httpClient;
    private $httpMethod;

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct($httpMethod, $query, $config)
    {
        if (empty($query) || !isset($query)) {
            $query = new ODataQuery($config);
        }
        $this->httpMethod = $httpMethod;
        $this->query = $query;
        $this->config = $config;
        // Init
        $this->httpClient = new Client([
            'base_uri' => $this->config['base_uri'],
        ]);
    }

    public function execute($entity, $body = null)
    {
        $resp = null;
        $reqURI = $this->getReqestURI($entity);
        $params = $this->getReqestParams($body);
        try {
            $resp = $this->httpClient->request($this->httpMethod, $reqURI, $params);
            //return $resp;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $ex_message = "Unkown Error!";
            $ex_code = -1;

            if ($e->hasResponse()) {
                $resp = $e->getResponse();
                $req = $e->getRequest();
                $stats = [
                    "%s" => \GuzzleHttp\Exception\RequestException::getResponseBodySummary($resp),
                    "StatusCode => %s" => $resp->getStatusCode(),
                    "Method => %s" => $req->getMethod(),
                    "URI => %s" => $req->getUri(),
                    "Body => %s" => json_encode($body)
                ];
                $ex_message = sprintf(
                    implode("\n\t", array_keys($stats)),
                    $stats["%s"],
                    $stats["StatusCode => %s"],
                    $stats["Method => %s"],
                    $stats["URI => %s"],
                    $stats["Body => %s"]
                );
            }
            throw new \Exception($ex_message, $ex_code);
        }
        return json_decode($resp->getBody());
    }

    private function getReqestURI($entity)
    {
        $reqURI = sprintf('%s%s', $entity, $this->query->getQuerySegment());
        return $reqURI;
    }

    private function getReqestParams($body = null)
    {
        $params = [];
        if (isset($body)) {
            $params['json'] = $body;
        }
        return $params;
    }
}
