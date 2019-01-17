<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\DealSourcesService
 *
 * Class used to make actions related to DealSource resource.
 *
 * @package BaseCRM
 */
class DealSourcesService
{
  // @var array Allowed attribute names.
  protected static $keysToPersist = ['name', 'resource_type'];

  protected $httpClient;

  /**
   * Instantiate a new DealSourcesService instance.
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
   * get '/deal_sources'
   *
   * Returns all deal sources available to the user according to the parameters provided
   *
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of DealSources for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $deal_sources) = $this->httpClient->get("/deal_sources", $params, $options);
    return $deal_sources;
  }

  /**
   * Create a new source
   *
   * post '/deal_sources'
   *
   * Creates a new source
   * <figure class="notice">
   * Source's name **must** be unique
   * </figure>
   *
   * @param array $dealSource This array's attributes describe the object to be created.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing created resource.
   */
  public function create(array $dealSource, array $options = array())
  {
    $attributes = array_intersect_key($dealSource, array_flip(self::$keysToPersist));

    list($code, $createdDealSource) = $this->httpClient->post("/deal_sources", $attributes, $options);
    return $createdDealSource;
  }

  /**
   * Retrieve a single source
   *
   * get '/deal_sources/{id}'
   *
   * Returns a single source available to the user by the provided id
   * If a source with the supplied unique identifier does not exist it returns an error
   *
   * @param integer $id Unique identifier of a DealSource
   * @param array $options Additional request's options.
   *
   * @return array Searched DealSource.
   */
  public function get($id, array $options = array())
  {
    list($code, $deal_source) = $this->httpClient->get("/deal_sources/{$id}", null, $options);
    return $deal_source;
  }

  /**
   * Update a source
   *
   * put '/deal_sources/{id}'
   *
   * Updates source information
   * If the specified source does not exist, the request will return an error
   * <figure class="notice">
   * If you want to update a source, you **must** make sure source's name is unique
   * </figure>
   *
   * @param integer $id Unique identifier of a DealSource
   * @param array $dealSource This array's attributes describe the object to be updated.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing updated resource.
   */
  public function update($id, array $dealSource, array $options = array())
  {
    $attributes = array_intersect_key($dealSource, array_flip(self::$keysToPersist));

    list($code, $updatedDealSource) = $this->httpClient->put("/deal_sources/{$id}", $attributes, $options);
    return $updatedDealSource;
  }

  /**
   * Delete a source
   *
   * delete '/deal_sources/{id}'
   *
   * Delete an existing source
   * If the specified source does not exist, the request will return an error
   * This operation cannot be undone
   *
   * @param integer $id Unique identifier of a DealSource
   * @param array $options Additional request's options.
   *
   * @return boolean Status of the operation.
   */
  public function destroy($id, array $options = array())
  {
    list($code, $payload) = $this->httpClient->delete("/deal_sources/{$id}", null, $options);
    return $code == 204;
  }
}
