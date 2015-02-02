<?php
namespace BaseCrm;


/**
 * BaseCrm\Response
 *
 * The HTTP Response object, holds the code and parsed data
 *
 * @package    BaseCrm
 * @author     Marcin Bunsch <marcin.bunsch@gmail.com>
 */
class Response
{

  /**
   * @var string Response code
   */
  public $code;

  /**
   * @var string Parsed response body
   */
  public $data;

  /**
   * Clients accept an array of constructor parameters.
   *
   * @param string $code Response code
   * @param mixed $data Response data
   */
  public function __construct($code, $data)
  {
    $this->code = $code;
    $this->data = $data;
  }

}


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


/**
 * BaseCrm\Client
 *
 * The client is the entry point to all actions
 *
 * @package    BaseCrm
 * @author     Marcin Bunsch <marcin.bunsch@gmail.com>
 */
class Client
{

    /**
     * @var string Base authentication token
     * @ignore
     */
    private $token;

    /**
     * @var \BaseCrm\Scope Contacts scope
     */
    public $contacts;

    /**
     * @var \BaseCrm\Scope Leads scope
     */
    public $leads;

    /**
     * Clients accept an array of constructor parameters.
     *
     * Here's an example of creating a client with a token
     *
     *   $client = new Client([ "token" => 'my_token'])
     *
     * @param array $config Client configuration settings
     *    - token: Base authentication token
     */
    public function __construct(array $config = [])
    {
        $this->token = $config['token'];
        $this->contacts = new Scope(
            $this,
            "https://crm.futuresimple.com/api/v1/contacts",
            array("namespace" => "contact")
        );
        $this->leads = new LeadsScope(
            $this,
            "https://leads.futuresimple.com/api/v1/leads",
            array("namespace" => "lead")
        );
    }

    /**
     * Get the Base authentication token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Perform a GET request
     *
     * @param string $url Url to send the request to.
     * @param array $params Query params to send with the request. They are converted to a query string and attached to the url.
     *
     * @return \BaseCrm\Response
     */
    public function getRequest($url, $params = null)
    {
        return $this->queryRequest("GET", $url, $params);
    }

    /**
     * Perform a POST request
     *
     * @param string $url Url to send the request to.
     * @param array $params Query params to send with the request. They are converted to json and sent in the body.
     *
     * @return \BaseCrm\Response
     */
    public function postRequest($url, $params = null)
    {
        return $this->bodyRequest("POST", $url, $params);
    }

    /**
     * Perform a PUT request
     *
     * @param string $url Url to send the request to.
     * @param array $params Query params to send with the request. They are converted to json and sent in the body.
     *
     * @return \BaseCrm\Response
     */
    public function putRequest($url, $params = null)
    {
        return $this->bodyRequest("PUT", $url, $params);
    }

    /**
     * Perform a DELETE request
     *
     * @param string $url Url to send the request to.
     * @param array $params Query params to send with the request. They are converted to a query string and attached to the url.
     *
     * @return \BaseCrm\Response
     */
    public function deleteRequest($url, $params = null)
    {
        return $this->queryRequest("DELETE", $url, $params);
    }

    /**
     * @ignore
     */
    private function queryRequest($method, $url, $params = null) {

        $curl = curl_init();

        $headers = $this->buildHeaders();

        if ($params) {
            $query = http_build_query($params);
            $url = "$url?$query";
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        $resp = curl_exec($curl);

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $data = json_decode($resp);

        $response = new Response($code, $data);

        curl_close($curl);

        return $response;

    }

    /**
     * @ignore
     */
    private function bodyRequest($method, $url, $params = array()) {

        $curl = curl_init();

        $headers = $this->buildHeaders();

        $data = json_encode($params);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);

        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $data = json_decode($resp);

        $response = new Response($code, $data);

        curl_close($curl);

        return $response;

    }

    /**
     * @ignore
     */
    private function buildHeaders()
    {
        return array(
            "X-Pipejump-Auth: " . $this->token,
            "X-Futuresimple-Token: " . $this->token,
            "Content-Type: application/json",
            "Accept: application/json",
        );

    }

}

