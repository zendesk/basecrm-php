<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\TasksService
 *
 * Class used to make actions related to Task resource.
 *
 * @package BaseCRM
 */
class TasksService
{
  // @var array Allowed attribute names.
  protected static $keysToPersist = ['completed', 'content', 'due_date', 'owner_id', 'remind_at', 'resource_id', 'resource_type'];

  protected $httpClient;

  /**
   * Instantiate a new TasksService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve all tasks
   *
   * get '/tasks'
   *
   * Returns all tasks available to the user, according to the parameters provided
   * If you ask for tasks without any parameter provided Base API will return you both **floating** and **related** tasks
   * Although you can narrow the search set to either of them via query parameters
   *
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of Tasks for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $tasks) = $this->httpClient->get("/tasks", $params, $options);
    return $tasks;
  }

  /**
   * Create a task
   *
   * post '/tasks'
   *
   * Creates a new task
   * You can create either a **floating** task or create a **related** task and associate it with one of the resource types below:
   * * [Leads](/docs/rest/reference/leads)
   * * [Contacts](/docs/rest/reference/contacts)
   * * [Deals](/docs/rest/reference/deals)
   *
   * @param array $task This array's attributes describe the object to be created.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing created resource.
   */
  public function create(array $task, array $options = array())
  {
    $attributes = array_intersect_key($task, array_flip(self::$keysToPersist));

    list($code, $createdTask) = $this->httpClient->post("/tasks", $attributes, $options);
    return $createdTask;
  }

  /**
   * Retrieve a single task
   *
   * get '/tasks/{id}'
   *
   * Returns a single task available to the user according to the unique task ID provided
   * If the specified task does not exist, this query will return an error
   *
   * @param integer $id Unique identifier of a Task
   * @param array $options Additional request's options.
   *
   * @return array Searched Task.
   */
  public function get($id, array $options = array())
  {
    list($code, $task) = $this->httpClient->get("/tasks/{$id}", null, $options);
    return $task;
  }

  /**
   * Update a task
   *
   * put '/tasks/{id}'
   *
   * Updates task information
   * If the specified task does not exist, this query will return an error
   *
   * @param integer $id Unique identifier of a Task
   * @param array $task This array's attributes describe the object to be updated.
   * @param array $options Additional request's options.
   *
   * @return array The resulting object representing updated resource.
   */
  public function update($id, array $task, array $options = array())
  {
    $attributes = array_intersect_key($task, array_flip(self::$keysToPersist));

    list($code, $updatedTask) = $this->httpClient->put("/tasks/{$id}", $attributes, $options);
    return $updatedTask;
  }

  /**
   * Delete a task
   *
   * delete '/tasks/{id}'
   *
   * Delete an existing task
   * If the specified task does not exist, this query will return an error
   * This operation cannot be undone
   *
   * @param integer $id Unique identifier of a Task
   * @param array $options Additional request's options.
   *
   * @return boolean Status of the operation.
   */
  public function destroy($id, array $options = array())
  {
    list($code, $payload) = $this->httpClient->delete("/tasks/{$id}", null, $options);
    return $code == 204;
  }
}
