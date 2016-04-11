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
   * @param array $params Search parameters
   * @param bool $has_more Flag set to true|false depending if there are more pages of data to fetch
   * 
   * @return array The list of Pipelines for the first page, unless otherwise specified.
   */
  public function all($params = [], &$has_more = null)
  {
    $options      = [];
    $needs_unwrap = false;
    if( count( func_get_args()) > 1 ) { // -- has_more flag was provided
      $options      = ['raw' => true];
      $needs_unwrap = true;
    }

    list($code, $items) = $this->httpClient->get("/pipelines", $params, $options);

    if( $needs_unwrap ) { // -- raw response
      $has_more = isset( $items['meta']['links']['next_page'] );
      $items    = $items['items'];
    }

    return $items;
  }
}
