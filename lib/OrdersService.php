<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\OrdersService
 *
 * Class used to make actions related to Order resource.
 *
 * @package BaseCRM
 */
class OrdersService
{
  // @var array Allowed attribute names.
  protected static $keysToPersist = ['deal_id', 'discount'];

  protected $httpClient;

  /**
   * Instantiate a new OrdersService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve all orders
   *
   * get '/orders'
   *
   * Returns all orders available to the user according to the parameters provided
   *
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of Orders for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $orders) = $this->httpClient->get("/orders", $params, $options);
    return $orders;
  }

  /**
   * Create an order
   *
   * post '/orders'
   *
   * Create a new order for a deal
   * User needs to have access to the deal to create an order
   * Each deal can have at most one order and error is returned when attempting to create more
   *
   * @param array $order This array's attributes describe the object to be created.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing created resource.
   */
  public function create(array $order, array $options = array())
  {
    $attributes = array_intersect_key($order, array_flip(self::$keysToPersist));

    list($code, $createdOrder) = $this->httpClient->post("/orders", $attributes, $options);
    return $createdOrder;
  }

  /**
   * Retrieve a single order
   *
   * get '/orders/{id}'
   *
   * Returns a single order available to the user, according to the unique order ID provided
   * If the specified order does not exist, the request will return an error
   *
   * @param integer $id Unique identifier of a Order
   * @param array $options Additional request's options.
   *
   * @return array Searched Order.
   */
  public function get($id, array $options = array())
  {
    list($code, $order) = $this->httpClient->get("/orders/{$id}", null, $options);
    return $order;
  }

  /**
   * Update an order
   *
   * put '/orders/{id}'
   *
   * Updates order information
   * If the specified order does not exist, the request will return an error
   *
   * @param integer $id Unique identifier of a Order
   * @param array $order This array's attributes describe the object to be updated.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing updated resource.
   */
  public function update($id, array $order, array $options = array())
  {
    $attributes = array_intersect_key($order, array_flip(self::$keysToPersist));

    list($code, $updatedOrder) = $this->httpClient->put("/orders/{$id}", $attributes, $options);
    return $updatedOrder;
  }

  /**
   * Delete an order
   *
   * delete '/orders/{id}'
   *
   * Delete an existing order and remove all of the associated line items in a single call
   * If the specified order does not exist, the request will return an error
   * This operation cannot be undone
   *
   * @param integer $id Unique identifier of a Order
   * @param array $options Additional request's options.
   *
   * @return boolean Status of the operation.
   */
  public function destroy($id, array $options = array())
  {
    list($code, $payload) = $this->httpClient->delete("/orders/{$id}", null, $options);
    return $code == 204;
  }
}
