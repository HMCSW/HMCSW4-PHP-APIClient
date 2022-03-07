<?php

namespace HMCSW4\Client\Exceptions;

use Exception;

class UnknownErrorException extends Exception
{
  public array $errors;

  public function __construct (string $message, int $code, array $errors = [])
  {
    parent::__construct($message, $code);
    $this->errors = $errors;
  }

  public function getErrors (): array
  {
    return $this->errors;
  }
}