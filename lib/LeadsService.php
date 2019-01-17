<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\LeadsService
 *
 * Class used to make actions related to Lead resource.
 *
 * @package BaseCRM
 */
class LeadsService
{
  // @var array Allowed attribute names.
  protected static $keysToPersist = ['address', 'custom_fields', 'description', 'email', 'facebook', 'fax', 'first_name', 'industry', 'last_name', 'linkedin', 'mobile', 'organization_name', 'owner_id', 'phone', 'skype', 'source_id', 'status', 'tags', 'title', 'twitter', 'website'];

  protected $httpClient;

  /**
   * Instantiate a new LeadsService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve all leads
   *
   * get '/leads'
   *
   * Returns all leads available to the user, according to the parameters provided
   *
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of Leads for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $leads) = $this->httpClient->get("/leads", $params, $options);
    return $leads;
  }

  /**
   * Create a lead
   *
   * post '/leads'
   *
   * Creates a new lead
   * A lead may represent a single individual or an organization
   *
   * @param array $lead This array's attributes describe the object to be created.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing created resource.
   */
  public function create(array $lead, array $options = array())
  {
    $attributes = array_intersect_key($lead, array_flip(self::$keysToPersist));
    if (isset($attributes['custom_fields']) && empty($attributes['custom_fields'])) unset($attributes['custom_fields']);

    list($code, $createdLead) = $this->httpClient->post("/leads", $attributes, $options);
    return $createdLead;
  }

  /**
   * Retrieve a single lead
   *
   * get '/leads/{id}'
   *
   * Returns a single lead available to the user, according to the unique lead ID provided
   * If the specified lead does not exist, this query returns an error
   *
   * @param integer $id Unique identifier of a Lead
   * @param array $options Additional request's options.
   *
   * @return array Searched Lead.
   */
  public function get($id, array $options = array())
  {
    list($code, $lead) = $this->httpClient->get("/leads/{$id}", null, $options);
    return $lead;
  }

  /**
   * Update a lead
   *
   * put '/leads/{id}'
   *
   * Updates lead information
   * If the specified lead does not exist, this query returns an error
   * <figure class="notice">
   * In order to modify tags, you need to supply the entire set of tags
   * `tags` are replaced every time they are used in a request
   * </figure>
   *
   * @param integer $id Unique identifier of a Lead
   * @param array $lead This array's attributes describe the object to be updated.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing updated resource.
   */
  public function update($id, array $lead, array $options = array())
  {
    $attributes = array_intersect_key($lead, array_flip(self::$keysToPersist));
    if (isset($attributes['custom_fields']) && empty($attributes['custom_fields'])) unset($attributes['custom_fields']);

    list($code, $updatedLead) = $this->httpClient->put("/leads/{$id}", $attributes, $options);
    return $updatedLead;
  }

  /**
   * Delete a lead
   *
   * delete '/leads/{id}'
   *
   * Delete an existing lead
   * If the specified lead does not exist, this query returns an error
   * This operation cannot be undone
   *
   * @param integer $id Unique identifier of a Lead
   * @param array $options Additional request's options.
   *
   * @return boolean Status of the operation.
   */
  public function destroy($id, array $options = array())
  {
    list($code, $payload) = $this->httpClient->delete("/leads/{$id}", null, $options);
    return $code == 204;
  }
}
