<?php
namespace BaseCRM\Errors;

use Exception;

class BaseError extends Exception
{
  public $httpStatusCode, $errors, $meta;

  public function __construct($httpStatusCode, $response)
  {
    $this->httpStatusCode = $httpStatusCode;
    $this->meta           = $response['meta'];
    $this->errors         = [];

    if( isset( $response['errors'] ) && is_array( $response['errors'] )) { // -- errors given
      $this->errors = array_map(function($data){ return $data['error'];  }, $response['errors']);

      $extractError = function($error) {
        $message = $error['message'] . ($error['details'] ? ': '.$error['details'] : '');
        return "resource=" . @$error['resource'] . " field=" . @$error['field'] . " code=" . $error['code'] . " message=" . $message;
      };

      $msg = implode("\n", array_map($extractError, $this->errors));
    } else {
      $msg = 'Unknown Error: HTTP '.$this->httpStatusCode;
    }

    parent::__construct($msg);
  }

  public function getHttpStatusCode()
  {
    return $this->httpStatusCode;
  }

  public function getRequestId()
  {
    return $this->meta['logref'];
  }
}

