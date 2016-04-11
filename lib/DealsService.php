<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\DealsService
 *
 * Class used to make actions related to Deal resource.
 * 
 * @package BaseCRM
 */
class DealsService
{
  // @var array Allowed attribute names.
  protected static $keysToPersist = ['contact_id', 'currency', 'custom_fields', 'estimated_close_date', 'hot', 'loss_reason_id', 'name', 'owner_id', 'source_id', 'stage_id', 'tags', 'value'];

  protected $httpClient;

  /**
   * Instantiate a new DealsService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve all deals
   *
   * get '/deals'
   * 
   * Returns all deals available to the user according to the parameters provided
   *
   * @param array $params Search parameters
   * @param bool $has_more Flag set to true|false depending if there are more pages of data to fetch
   * 
   * @return array The list of Deals for the first page, unless otherwise specified.
   */
  public function all($params = [], &$has_more = null)
  {
    $options      = [];
    $needs_unwrap = false;
    if( count( func_get_args()) > 1 ) { // -- hasMore flag was provided
      $options      = ['raw' => true];
      $needs_unwrap = true;
    }

    list($code, $items) = $this->httpClient->get("/deals", $params, $options);

    if( $needs_unwrap ) { // -- raw response
      $has_more = isset( $items['meta']['links']['next_page'] );
      $items    = $items['items'];
    }

    return $items;
  }

  /**
   * Create a deal
   *
   * post '/deals'
   * 
   * Create a new deal
   *
   * @param array $deal This array's attributes describe the object to be created.
   * 
   * @return array The resulting object representing created resource.
   */
  public function create(array $deal)
  {
    $attributes = array_intersect_key($deal, array_flip(self::$keysToPersist));
    if (isset($attributes['custom_fields']) && empty($attributes['custom_fields'])) unset($attributes['custom_fields']);
 
    list($code, $createdDeal) = $this->httpClient->post("/deals", $attributes);
    return $createdDeal; 
  }

  /**
   * Retrieve a single deal
   *
   * get '/deals/{id}'
   * 
   * Returns a single deal available to the user, according to the unique deal ID provided
   * If the specified deal does not exist, the request will return an error
   *
   * @param integer $id Unique identifier of a Deal
   * 
   * @return array Searched Deal.
   */
  public function get($id)
  {
    list($code, $deal) = $this->httpClient->get("/deals/{$id}");
    return $deal;
  }
 
  /**
   * Update a deal
   *
   * put '/deals/{id}'
   * 
   * Updates deal information
   * If the specified deal does not exist, the request will return an error
   * <figure class="notice">
   * In order to modify tags used on a record, you need to supply the entire set
   * `tags` are replaced every time they are used in a request
   * </figure>
   *
   * @param integer $id Unique identifier of a Deal
   * @param array $deal This array's attributes describe the object to be updated.
   * 
   * @return array The resulting object representing updated resource.
   */
  public function update($id, array $deal)
  {
    $attributes = array_intersect_key($deal, array_flip(self::$keysToPersist)); 
    if (isset($attributes['custom_fields']) && empty($attributes['custom_fields'])) unset($attributes['custom_fields']);
 
    list($code, $updatedDeal) = $this->httpClient->put("/deals/{$id}", $attributes);
    return $updatedDeal; 
  }

  /**
   * Delete a deal
   *
   * delete '/deals/{id}'
   * 
   * Delete an existing deal and remove all of the associated contacts from the deal in a single call
   * If the specified deal does not exist, the request will return an error
   * This operation cannot be undone
   *
   * @param integer $id Unique identifier of a Deal
   * 
   * @return boolean Status of the operation.
   */
  public function destroy($id)
  {
    list($code, $payload) = $this->httpClient->delete("/deals/{$id}");
    return $code == 204;
  }
}
