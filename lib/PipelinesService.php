<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\PipelinesService
 *
 * Class used to make actions related to Pipeline resource.
 *
 * @package BaseCRM
 */
class PipelinesService
{
  protected $httpClient;

  /**
   * Instantiate a new PipelinesService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve all pipelines
   *
   * get '/pipelines'
   *
   * Returns all pipelines available to the user, according to the parameters provided
   *
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of Pipelines for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $pipelines) = $this->httpClient->get("/pipelines", $params, $options);
    return $pipelines;
  }
}
