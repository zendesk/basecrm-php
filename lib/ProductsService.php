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
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of Products for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $products) = $this->httpClient->get("/products", $params, $options);
    return $products;
  }

  /**
   * Create a product
   *
   * post '/products'
   *
   * Create a new product
   *
   * @param array $product This array's attributes describe the object to be created.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing created resource.
   */
  public function create(array $product, array $options = array())
  {
    $attributes = array_intersect_key($product, array_flip(self::$keysToPersist));

    list($code, $createdProduct) = $this->httpClient->post("/products", $attributes, $options);
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
   * @param array $options Additional request's options.
   *
   * @return array Searched Product.
   */
  public function get($id, array $options = array())
  {
    list($code, $product) = $this->httpClient->get("/products/{$id}", null, $options);
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
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing updated resource.
   */
  public function update($id, array $product, array $options = array())
  {
    $attributes = array_intersect_key($product, array_flip(self::$keysToPersist));

    list($code, $updatedProduct) = $this->httpClient->put("/products/{$id}", $attributes, $options);
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
   * @param array $options Additional request's options.
   *
   * @return boolean Status of the operation.
   */
  public function destroy($id, array $options = array())
  {
    list($code, $payload) = $this->httpClient->delete("/products/{$id}", null, $options);
    return $code == 204;
  }
}
