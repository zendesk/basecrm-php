<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\VisitsService
 *
 * Class used to make actions related to Visit resource.
 *
 * @package BaseCRM
 */
class VisitsService
{
  protected $httpClient;

  /**
   * Instantiate a new VisitsService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve visits
   *
   * get '/visits'
   *
   * Returns Visits, according to the parameters provided
   *
   * @param array $options Search options
   *
   * @return array The list of Visits for the first page, unless otherwise specified.
   */
  public function all($options = [])
  {
    list($code, $visits) = $this->httpClient->get("/visits", $options);
    return $visits;
  }
}
