<?php namespace rdrei\odata;

/**
 *  ODataClient class to create OData Querys
 *  @author rdrei <info@r-drei.de>
 */
class ODataQuery
{

  private $config;
  private $parameters = [];
  private $byEntityKey = null;

  public function __construct($config = [])
  {
    $this->config = $config;
  }
  /**
   * Add Filter function to Query
   *
   * @param string $filter
   * @return ODataQuery
   */
  public function filter($filter)
  {
    if (!empty($filter) && isset($filter)) {
      $this->parameters['$filter'] = $filter;
    }
    return $this;
  }
  /**
   * Add OrderBy function to Query
   *
   * @param string $field
   * @param bool $asc
   * @return ODataQuery
   */
  public function orderBy($field, $asc = false)
  {
    if (!empty($field) && isset($field)) {
      $this->parameters['$orderby'] = $field;
    }
    return $this;
  }
  /**
   * Add Select function to Query
   *
   * @param string $field
   * @return ODataQuery
   */
  public function select($field)
  {
    if (!empty($field) && isset($field)) {
      $this->parameters['$select'] = $field;
    }

    return $this;
  }
  /**
   * Add Expand function to Query
   *
   * @param string $field
   * @return ODataQuery
   */
  public function expand($field)
  {
    if (!empty($field) && isset($field)) {
      $this->parameters['$expand'] = $field;
    }

    return $this;
  }

  /**
   * Add Skip function to Query
   *
   * @param number $skip
   * @return ODataQuery
   */
  public function skip($skip = 0)
  {
    $this->parameters['$skip'] = $skip;
    return $this;
  }
  /**
   * Add Take function to Query
   *
   * @param number $take
   * @return ODataQuery
   */
  public function take($take = 0)
  {
    $this->parameters['$top'] = $take;
    return $this;
  }

  /**
   * Add Inline-Count function to Query
   *
   * @return ODataQuery
   */
  public function inlineCount()
  {
    $this->parameters['$inlinecount'] = "allpages";
    return $this;
  }

  /**
   * Add Count function to Query
   *
   * @return ODataQuery
   */
  public function Count()
  {
    $this->parameters['$count'] = "true";
    return $this;
  }

  /**
   * Add Format function to Query
   *
   * @param string $format
   * @return ODataQuery
   */
  public function format($format)
  {
    if (!empty($format) && isset($format)) {
      $this->parameters['$format'] = $format;
    }

    return $this;
  }

  /**
   * Add byKey function to Query
   *
   * @param string $key
   * @return ODataQuery
   */
  public function byKey($key)
  {
    if (!empty($key) && isset($key)) {
      $this->byEntityKey = sprintf("'%s'", $key);
    }

    return $this;
  }


  public function getQuerySegment()
  {
    $result = "";
    if ($this->byEntityKey) {
      $byKeySegment = sprintf("(%s)", $this->byEntityKey);
      $result = sprintf("%s", $byKeySegment);
    }
    if ($this->parameters) {
      $urlQuerys = http_build_query($this->parameters);
      $result = sprintf("%s?%s", $result, $urlQuerys);
    }
    return $result;
  }
}
