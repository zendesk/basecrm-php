<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\LeadSourcesService
 *
 * Class used to make actions related to LeadSource resource.
 *
 * @package BaseCRM
 */
class LeadSourcesService
{
  // @var array Allowed attribute names.
  protected static $keysToPersist = ['name', 'resource_type'];

  protected $httpClient;

  /**
   * Instantiate a new LeadSourcesService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve all sources
   *
   * get '/lead_sources'
   *
   * Returns all lead sources available to the user according to the parameters provided
   *
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of LeadSources for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $lead_sources) = $this->httpClient->get("/lead_sources", $params, $options);
    return $lead_sources;
  }

  /**
   * Create a new source
   *
   * post '/lead_sources'
   *
   * Creates a new source
   * <figure class="notice">
   * Source's name **must** be unique
   * </figure>
   *
   * @param array $leadSource This array's attributes describe the object to be created.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing created resource.
   */
  public function create(array $leadSource, array $options = array())
  {
    $attributes = array_intersect_key($leadSource, array_flip(self::$keysToPersist));

    list($code, $createdLeadSource) = $this->httpClient->post("/lead_sources", $attributes, $options);
    return $createdLeadSource;
  }

  /**
   * Retrieve a single source
   *
   * get '/lead_sources/{id}'
   *
   * Returns a single source available to the user by the provided id
   * If a source with the supplied unique identifier does not exist it returns an error
   *
   * @param integer $id Unique identifier of a LeadSource
   * @param array $options Additional request's options.
   *
   * @return array Searched LeadSource.
   */
  public function get($id, array $options = array())
  {
    list($code, $lead_source) = $this->httpClient->get("/lead_sources/{$id}", null, $options);
    return $lead_source;
  }

  /**
   * Update a source
   *
   * put '/lead_sources/{id}'
   *
   * Updates source information
   * If the specified source does not exist, the request will return an error
   * <figure class="notice">
   * If you want to update a source, you **must** make sure source's name is unique
   * </figure>
   *
   * @param integer $id Unique identifier of a LeadSource
   * @param array $leadSource This array's attributes describe the object to be updated.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing updated resource.
   */
  public function update($id, array $leadSource, array $options = array())
  {
    $attributes = array_intersect_key($leadSource, array_flip(self::$keysToPersist));

    list($code, $updatedLeadSource) = $this->httpClient->put("/lead_sources/{$id}", $attributes, $options);
    return $updatedLeadSource;
  }

  /**
   * Delete a source
   *
   * delete '/lead_sources/{id}'
   *
   * Delete an existing source
   * If the specified source does not exist, the request will return an error
   * This operation cannot be undone
   *
   * @param integer $id Unique identifier of a LeadSource
   * @param array $options Additional request's options.
   *
   * @return boolean Status of the operation.
   */
  public function destroy($id, array $options = array())
  {
    list($code, $payload) = $this->httpClient->delete("/lead_sources/{$id}", null, $options);
    return $code == 204;
  }
}
