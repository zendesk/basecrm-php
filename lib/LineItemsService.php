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
   * @param array $options Search options
   *
   * @return array The list of LineItems for the first page, unless otherwise specified.
   */
  public function all($order_id, $options = [])
  {
    list($code, $lineItems) = $this->httpClient->get("/orders/{$order_id}/line_items", $options);
    $lineItemsData = array_map(array($this, 'coerceNestedLineItemData'), $lineItems);
    return $lineItemsData;
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
   *
   * @return array The resulting object representing created resource.
   */
  public function create($order_id, array $lineItem)
  {
    $attributes = array_intersect_key($lineItem, array_flip(self::$keysToPersist));

    $attributes['value'] = Coercion::toStringValue($attributes['value']);
    $attributes['variation'] = Coercion::toStringValue($attributes['variation']);
    list($code, $createdLineItem) = $this->httpClient->post("/orders/{$order_id}/line_items", $attributes);
    $createdLineItem = $this->coerceLineItemData($createdLineItem);
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
   *
   * @return array Searched LineItem.
   */
  public function get($order_id, $id)
  {
    list($code, $lineItem) = $this->httpClient->get("/orders/{$order_id}/line_items/{$id}");
    $lineItem = $this->coerceLineItemData($lineItem);
    return $lineItem;
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
   *
   * @return boolean Status of the operation.
   */
  public function destroy($order_id, $id)
  {
    list($code, $payload) = $this->httpClient->delete("/orders/{$order_id}/line_items/{$id}");
    return $code == 204;
  }

  private function coerceNestedLineItemData(array $nestedLineItem)
  {
    $rawLineItem = $this->coerceLineItemData($nestedLineItem['data']);
    $nestedLineItem['data'] = $rawLineItem;
    return $nestedLineItem;
  }

  private function coerceLineItemData(array $lineItem)
  {
    $lineItem['value'] = Coercion::toFloatValue($lineItem['value']);
    $lineItem['variation'] = Coercion::toFloatValue($lineItem['variation']);
    $lineItem['price'] = Coercion::toFloatValue($lineItem['price']);
    return $lineItem;
  }
}
