<?php
//  WARNING: This code is auto-generated from the BaseCRM API Discovery JSON Schema
namespace BaseCRM;

/**
 * BaseCRM\TextMessagesService
 *
 * Class used to make actions related to TextMessage resource.
 *
 * @package BaseCRM
 */
class TextMessagesService
{
  protected $httpClient;

  /**
   * Instantiate a new TextMessagesService instance.
   *
   * @param BaseCRM\HttpClient $httpClient Http client.
   */
  public function __construct(HttpClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  /**
   * Retrieve text messages
   *
   * get '/text_messages'
   *
   * Returns Text Messages, according to the parameters provided
   *
   * @param array $options Search options
   *
   * @return array The list of TextMessages for the first page, unless otherwise specified.
   */
  public function all($options = [])
  {
    list($code, $text_messages) = $this->httpClient->get("/text_messages", $options);
    return $text_messages;
  }

  /**
   * Retrieve a single text message
   *
   * get '/text_messages/{id}'
   *
   * Returns a single text message according to the unique  ID provided
   * If the specified user does not exist, this query returns an error
   *
   * @param integer $id Unique identifier of a TextMessage
   *
   * @return array Searched TextMessage.
   */
  public function get($id)
  {
    list($code, $text_message) = $this->httpClient->get("/text_messages/{$id}");
    return $text_message;
  }
}
