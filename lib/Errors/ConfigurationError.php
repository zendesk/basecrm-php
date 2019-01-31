<?php
namespace BaseCRM\Errors;

use Exception;

class ConfigurationError extends Exception
{
  protected $error_message;
  
  public function __construct($message)
  {
    parent::__construct($message);
    $this->error_message = $message;
  }

  public function getErrorMessage()
  {
    return $this->error_message;
  }
}
