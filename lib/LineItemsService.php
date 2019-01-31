<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\LineItemsService
 *
 * Class used to make actions related to LineItem resource.
 *
 * @package BaseCRM
 */
class LineItemsService
{
  // @var array Allowed attribute names.
  protected static $keysToPersist = ['product_id', 'value', 'variation', 'currency', 'quantity'];

  protected $httpClient;

  /**
   * Instantiate a new LineItemsService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve order's line items
   *
   * get '/orders/{order_id}/line_items'
   *
   * Returns all line items associated to order
   *
   * @param integer $order_id Unique identifier of a Order
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of LineItems for the first page, unless otherwise specified.
   */
  public function all($order_id, $params = [], array $options = array())
  {
    list($code, $line_items) = $this->httpClient->get("/orders/{$order_id}/line_items", $params, $options);
    return $line_items;
  }

  /**
   * Create a line item
   *
   * post '/orders/{order_id}/line_items'
   *
   * Adds a new line item to an existing order
   * Line items correspond to products in the catalog, so first you must create products
   * Because products allow defining different prices in different currencies, when creating a line item, the parameter currency is required
   *
   * @param integer $order_id Unique identifier of a Order
   * @param array $lineItem This array's attributes describe the object to be created.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing created resource.
   */
  public function create($order_id, array $lineItem, array $options = array())
  {
    $attributes = array_intersect_key($lineItem, array_flip(self::$keysToPersist));

    list($code, $createdLineItem) = $this->httpClient->post("/orders/{$order_id}/line_items", $attributes, $options);
    return $createdLineItem;
  }

  /**
   * Retrieve a single line item
   *
   * get '/orders/{order_id}/line_items/{id}'
   *
   * Returns a single line item of an order, according to the unique line item ID provided
   *
   * @param integer $order_id Unique identifier of a Order
   * @param integer $id Unique identifier of a LineItem
   * @param array $options Additional request's options.
   *
   * @return array Searched LineItem.
   */
  public function get($order_id, $id, array $options = array())
  {
    list($code, $line_item) = $this->httpClient->get("/orders/{$order_id}/line_items/{$id}", null, $options);
    return $line_item;
  }

  /**
   * Delete a line item
   *
   * delete '/orders/{order_id}/line_items/{id}'
   *
   * Remove an order’s line item
   * This operation cannot be undone
   *
   * @param integer $order_id Unique identifier of a Order
   * @param integer $id Unique identifier of a LineItem
   * @param array $options Additional request's options.
   *
   * @return boolean Status of the operation.
   */
  public function destroy($order_id, $id, array $options = array())
  {
    list($code, $payload) = $this->httpClient->delete("/orders/{$order_id}/line_items/{$id}", null, $options);
    return $code == 204;
  }
}
