<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\SourcesService
 *
 * Class used to make actions related to Source resource.
 * 
 * @package BaseCRM
 */
class SourcesService
{
  // @var array Allowed attribute names.
  protected static $keysToPersist = ['name'];

  protected $httpClient;

  /**
   * Instantiate a new SourcesService instance.
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
   * get '/sources'
   * 
   * Returns all deal sources available to the user according to the parameters provided
   *
   * @param array $params Search parameters
   * @param bool $has_more Flag set to true|false depending if there are more pages of data to fetch
   * 
   * @return array The list of Sources for the first page, unless otherwise specified.
   */
  public function all($params = [], &$has_more = null)
  {
    $options      = [];
    $needs_unwrap = false;
    if( count( func_get_args()) > 1 ) { // -- has_more flag was provided
      $options      = ['raw' => true];
      $needs_unwrap = true;
    }

    list($code, $items) = $this->httpClient->get("/sources", $params, $options);

    if( $needs_unwrap ) { // -- raw response
      $has_more = isset( $items['meta']['links']['next_page'] );
      $items    = $items['items'];
    }

    return $items;
  }

  /**
   * Create a source
   *
   * post '/sources'
   * 
   * Creates a new source
   * <figure class="notice">
   * Source's name **must** be unique
   * </figure>
   *
   * @param array $source This array's attributes describe the object to be created.
   * 
   * @return array The resulting object representing created resource.
   */
  public function create(array $source)
  {
    $attributes = array_intersect_key($source, array_flip(self::$keysToPersist));
 
    list($code, $createdSource) = $this->httpClient->post("/sources", $attributes);
    return $createdSource; 
  }

  /**
   * Retrieve a single source
   *
   * get '/sources/{id}'
   * 
   * Returns a single source available to the user by the provided id
   * If a source with the supplied unique identifier does not exist it returns an error
   *
   * @param integer $id Unique identifier of a Source
   * 
   * @return array Searched Source.
   */
  public function get($id)
  {
    list($code, $source) = $this->httpClient->get("/sources/{$id}");
    return $source;
  }
 
  /**
   * Update a source
   *
   * put '/sources/{id}'
   * 
   * Updates source information
   * If the specified source does not exist, the request will return an error
   * <figure class="notice">
   * If you want to update a source, you **must** make sure source's name is unique
   * </figure>
   *
   * @param integer $id Unique identifier of a Source
   * @param array $source This array's attributes describe the object to be updated.
   * 
   * @return array The resulting object representing updated resource.
   */
  public function update($id, array $source)
  {
    $attributes = array_intersect_key($source, array_flip(self::$keysToPersist)); 
 
    list($code, $updatedSource) = $this->httpClient->put("/sources/{$id}", $attributes);
    return $updatedSource; 
  }

  /**
   * Delete a source
   *
   * delete '/sources/{id}'
   * 
   * Delete an existing source
   * If the specified source does not exist, the request will return an error
   * This operation cannot be undone
   *
   * @param integer $id Unique identifier of a Source
   * 
   * @return boolean Status of the operation.
   */
  public function destroy($id)
  {
    list($code, $payload) = $this->httpClient->delete("/sources/{$id}");
    return $code == 204;
  }
}
