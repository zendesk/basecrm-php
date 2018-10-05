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
   * @param array $options Search options
   *
   * @return array The list of VisitOutcomes for the first page, unless otherwise specified.
   */
  public function all($options = [])
  {
    list($code, $visit_outcomes) = $this->httpClient->get("/visit_outcomes", $options);
    return $visit_outcomes;
  }
}
