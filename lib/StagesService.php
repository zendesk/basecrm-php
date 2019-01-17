<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\StagesService
 *
 * Class used to make actions related to Stage resource.
 *
 * @package BaseCRM
 */
class StagesService
{
  protected $httpClient;

  /**
   * Instantiate a new StagesService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve all stages
   *
   * get '/stages'
   *
   * Returns all stages available to the user, according to the parameters provided
   *
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of Stages for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $stages) = $this->httpClient->get("/stages", $params, $options);
    return $stages;
  }
}
