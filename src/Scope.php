<?php
namespace BaseCrm;

/**
 * BaseCrm\Scope
 *
 * The scope is used for making specific calls to an endpoint
 *
 * @package    BaseCrm
 * @author     Marcin Bunsch <marcin.bunsch@gmail.com>
 */
class Scope
{
  /**
   * @var BaseCrm\Client Client object
   * @ignore
   */
  protected $client;

  /**
   * @var string Endpoint
   * @ignore
   */
  protected $endpoint;

  /**
   * @var string Namespace used when packing/unpacking data
   * @ignore
   */
  protected $namespace;

  /**
   * Clients accept an array of constructor parameters.
   *
   * @param BaseCrm\Client $client Base client object
   * @param string $endpoint Endpoint
   * @param array $config Scope configuration settings
   *   - namespace: Namespace used for data packing/unpacking
   */
  public function __construct($client, $endpoint, $options = array())
  {
    $this->client = $client;
    $this->endpoint = $endpoint;
    $this->namespace = $options['namespace'];
  }

  /**
   * Fetch a collection of resources.
   *
   * @param array $params Params passed to the API
   * @return BaseCrm\Response
   */
  public function all($params = array()) {
    $url = "{$this->endpoint}.json";
    $response = $this->client->getRequest($url, $params);
    if ($this->namespace) {
      $this->unpackResponseCollection($response);
    }
    return $response;
  }

  /**
   * Fetch a single resource
   *
   * @param num $id Id of the resource
   * @return BaseCrm\Response
   */
  public function get($id) {
    $url = "{$this->endpoint}/$id.json";
    $response = $this->client->getRequest($url);
    if ($this->namespace) $this->unpackResponseSingle($response);
    return $response;
  }

  /**
   * Destroy a single resource
   *
   * @param num $id Id of the resource
   * @return BaseCrm\Response
   */
  public function destroy($id) {
    $url = "{$this->endpoint}/$id.json";
    return $this->client->deleteRequest($url);
  }

  /**
   * Create a resource
   *
   * @param array $params Params passed to the API
   * @return BaseCrm\Response
   */
  public function create($params) {
    $url = "{$this->endpoint}.json";
    $payload = $this->buildPayload($params);
    $response = $this->client->postRequest($url, $payload);
    if ($this->namespace) $this->unpackResponseSingle($response);
    return $response;
  }

  /**
   * Update a resource
   *
   * @param num $id If of the resource
   * @param array $params Params passed to the API
   * @return BaseCrm\Response
   */
  public function update($id, $params) {
    $url = "{$this->endpoint}/$id.json";
    $payload = $this->buildPayload($params);
    $response = $this->client->putRequest($url, $payload);
    if ($this->namespace) $this->unpackResponseSingle($response);
    return $response;
  }

  /**
    * @ignore
    */
  protected function unpackResponseCollection($response) {
    $namespace = $this->namespace;
    foreach ($response->data as &$item) {
      $item = $item->$namespace;
    }
  }

  /**
    * @ignore
    */
  protected function unpackResponseSingle($response) {
    $namespace = $this->namespace;
    $response->data = $response->data->$namespace;
  }

  /**
    * @ignore
    */
  protected function buildPayload($params) {
    if ($this->namespace) {
      $data = array();
      $data[$this->namespace] = $params;
    } else {
      $data = $params;
    }
    return $data;
  }

}

class LeadsScope extends Scope
{

  protected function unpackResponseCollection($response) {
    $response->data = $response->data->items;
    $namespace = $this->namespace;
    foreach ($response->data as &$item) {
      $item = $item->$namespace;
    }
  }

  /**
    * @ignore
    */
  protected function unpackResponseSingle($response) {
    $namespace = $this->namespace;
    $response->data = $response->data->$namespace;
  }

}
