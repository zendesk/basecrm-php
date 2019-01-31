<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\LeadUnqualifiedReasonsService
 *
 * Class used to make actions related to LeadUnqualifiedReason resource.
 *
 * @package BaseCRM
 */
class LeadUnqualifiedReasonsService
{
  protected $httpClient;

  /**
   * Instantiate a new LeadUnqualifiedReasonsService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve all lead unqualified reasons
   *
   * get '/lead_unqualified_reasons'
   *
   * Returns all lead unqualified reasons available to the user according to the parameters provided
   *
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of LeadUnqualifiedReasons for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $lead_unqualified_reasons) = $this->httpClient->get("/lead_unqualified_reasons", $params, $options);
    return $lead_unqualified_reasons;
  }
}
