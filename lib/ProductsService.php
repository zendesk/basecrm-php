<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\ProductsService
 *
 * Class used to make actions related to Product resource.
 *
 * @package BaseCRM
 */
class ProductsService
{
  // @var array Allowed attribute names.
  protected static $keysToPersist = ['name', 'description', 'sku', 'active', 'cost', 'cost_currency', 'prices', 'max_discount', 'max_markup'];

  protected $httpClient;

  /**
   * Instantiate a new ProductsService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve all products
   *
   * get '/products'
   *
   * Returns all products available to the user according to the parameters provided
   *
   * @param array $options Search options
   *
   * @return array The list of Products for the first page, unless otherwise specified.
   */
  public function all($options = [])
  {
    list($code, $products) = $this->httpClient->get("/products", $options);
    $productsData = array_map(array($this, 'coerceNestedProductData'), $products);
    return $productsData;
  }

  /**
   * Create a product
   *
   * post '/products'
   *
   * Create a new product
   *
   * @param array $product This array's attributes describe the object to be created.
   *
   * @return array The resulting object representing created resource.
   */
  public function create(array $product)
  {
    $attributes = array_intersect_key($product, array_flip(self::$keysToPersist));

    $attributes['cost'] = Coercion::toStringValue($attributes['cost']);
    $attributes['prices'] = array_map(function($val) { $val['amount'] = Coercion::toStringValue($val['amount']); return $val; }, $attributes['prices']);
    list($code, $createdProduct) = $this->httpClient->post("/products", $attributes);
    $createdProduct = $this->coerceProductData($createdProduct);
    return $createdProduct;
  }

  /**
   * Retrieve a single product
   *
   * get '/products/{id}'
   *
   * Returns a single product, according to the unique product ID provided
   * If the specified product does not exist, the request will return an error
   *
   * @param integer $id Unique identifier of a Product
   *
   * @return array Searched Product.
   */
  public function get($id)
  {
    list($code, $product) = $this->httpClient->get("/products/{$id}");
    $product = $this->coerceProductData($product);
    return $product;
  }

  /**
   * Update a product
   *
   * put '/products/{id}'
   *
   * Updates product information
   * If the specified product does not exist, the request will return an error
   * <figure class="notice"><p>In order to modify prices used on a record, you need to supply the entire set
   * <code>prices</code> are replaced every time they are used in a request
   * </p></figure>
   *
   * @param integer $id Unique identifier of a Product
   * @param array $product This array's attributes describe the object to be updated.
   *
   * @return array The resulting object representing updated resource.
   */
  public function update($id, array $product)
  {
    $attributes = array_intersect_key($product, array_flip(self::$keysToPersist));

    list($code, $updatedProduct) = $this->httpClient->put("/products/{$id}", $attributes);
    $updatedProduct = $this->coerceProductData($updatedProduct);
    return $updatedProduct;
  }

  /**
   * Delete a product
   *
   * delete '/products/{id}'
   *
   * Delete an existing product from the catalog
   * Existing orders and line items are not affected
   * If the specified product does not exist, the request will return an error
   * This operation cannot be undone
   * Products can be removed only by an account administrator
   *
   * @param integer $id Unique identifier of a Product
   *
   * @return boolean Status of the operation.
   */
  public function destroy($id)
  {
    list($code, $payload) = $this->httpClient->delete("/products/{$id}");
    return $code == 204;
  }

  private function coerceNestedProductData(array $nestedProduct)
  {
    $rawProduct = $this->coerceProductData($nestedProduct['data']);
    $nestedProduct['data'] = $rawProduct;
    return $nestedProduct;
  }

  private function coerceProductData(array $product)
  {
    $product['cost'] = Coercion::toFloatValue($product['cost']);
    $product['prices'] = array_map(array($this, 'coerceProductPrice'), $product['prices']);
    return $product;
  }

  private function coerceProductPrice(array $price)
  {
    $price['amount'] = Coercion::toFloatValue($price['amount']);
    return $price;
  }

  private function coerceToStringProductPrice(array $price)
  {
    $price['amount'] = Coercion::toStringValue($price['amount']);
    return $price;
  }
}
