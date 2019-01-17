<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\DealUnqualifiedReasonsService
 *
 * Class used to make actions related to DealUnqualifiedReason resource.
 *
 * @package BaseCRM
 */
class DealUnqualifiedReasonsService
{
  // @var array Allowed attribute names.
  protected static $keysToPersist = ['name'];

  protected $httpClient;

  /**
   * Instantiate a new DealUnqualifiedReasonsService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve all deal unqualified reasons
   *
   * get '/deal_unqualified_reasons'
   *
   * Returns all deal unqualified reasons available to the user according to the parameters provided
   *
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of DealUnqualifiedReasons for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $deal_unqualified_reasons) = $this->httpClient->get("/deal_unqualified_reasons", $params, $options);
    return $deal_unqualified_reasons;
  }

  /**
   * Create a deal unqualified reason
   *
   * post '/deal_unqualified_reasons'
   *
   * Create a new deal unqualified reason
   * <figure class="notice">
   * Deal unqualified reason's name **must** be unique
   * </figure>
   *
   * @param array $dealUnqualifiedReason This array's attributes describe the object to be created.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing created resource.
   */
  public function create(array $dealUnqualifiedReason, array $options = array())
  {
    $attributes = array_intersect_key($dealUnqualifiedReason, array_flip(self::$keysToPersist));

    list($code, $createdDealUnqualifiedReason) = $this->httpClient->post("/deal_unqualified_reasons", $attributes, $options);
    return $createdDealUnqualifiedReason;
  }

  /**
   * Retrieve a single deal unqualified reason
   *
   * get '/deal_unqualified_reasons/{id}'
   *
   * Returns a single deal unqualified reason available to the user by the provided id
   * If a loss reason with the supplied unique identifier does not exist, it returns an error
   *
   * @param integer $id Unique identifier of a DealUnqualifiedReason
   * @param array $options Additional request's options.
   *
   * @return array Searched DealUnqualifiedReason.
   */
  public function get($id, array $options = array())
  {
    list($code, $deal_unqualified_reason) = $this->httpClient->get("/deal_unqualified_reasons/{$id}", null, $options);
    return $deal_unqualified_reason;
  }

  /**
   * Update a deal unqualified reason
   *
   * put '/deal_unqualified_reasons/{id}'
   *
   * Updates a deal unqualified reason information
   * If the specified deal unqualified reason does not exist, the request will return an error
   * <figure class="notice">
   * If you want to update deal unqualified reason you **must** make sure name of the reason is unique
   * </figure>
   *
   * @param integer $id Unique identifier of a DealUnqualifiedReason
   * @param array $dealUnqualifiedReason This array's attributes describe the object to be updated.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing updated resource.
   */
  public function update($id, array $dealUnqualifiedReason, array $options = array())
  {
    $attributes = array_intersect_key($dealUnqualifiedReason, array_flip(self::$keysToPersist));

    list($code, $updatedDealUnqualifiedReason) = $this->httpClient->put("/deal_unqualified_reasons/{$id}", $attributes, $options);
    return $updatedDealUnqualifiedReason;
  }

  /**
   * Delete a deal unqualified reason
   *
   * delete '/deal_unqualified_reasons/{id}'
   *
   * Delete an existing deal unqualified reason
   * If the reason with supplied unique identifier does not exist it returns an error
   * This operation cannot be undone
   *
   * @param integer $id Unique identifier of a DealUnqualifiedReason
   * @param array $options Additional request's options.
   *
   * @return boolean Status of the operation.
   */
  public function destroy($id, array $options = array())
  {
    list($code, $payload) = $this->httpClient->delete("/deal_unqualified_reasons/{$id}", null, $options);
    return $code == 204;
  }
}
