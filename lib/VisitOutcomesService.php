<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\VisitOutcomesService
 *
 * Class used to make actions related to VisitOutcome resource.
 *
 * @package BaseCRM
 */
class VisitOutcomesService
{
  protected $httpClient;

  /**
   * Instantiate a new VisitOutcomesService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve visit outcomes
   *
   * get '/visit_outcomes'
   *
   * Returns Visit Outcomes, according to the parameters provided
   *
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of VisitOutcomes for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $visit_outcomes) = $this->httpClient->get("/visit_outcomes", $params, $options);
    return $visit_outcomes;
  }
}
