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
   * @param array $params Search options
   * @param array $options Additional request's options.
   *
   * @return array The list of TextMessages for the first page, unless otherwise specified.
   */
  public function all($params = [], array $options = array())
  {
    list($code, $text_messages) = $this->httpClient->get("/text_messages", $params, $options);
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
   * @param array $options Additional request's options.
   *
   * @return array Searched TextMessage.
   */
  public function get($id, array $options = array())
  {
    list($code, $text_message) = $this->httpClient->get("/text_messages/{$id}", null, $options);
    return $text_message;
  }
}
