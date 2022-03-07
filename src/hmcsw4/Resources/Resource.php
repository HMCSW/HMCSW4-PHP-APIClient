<?php

namespace HMCSW4\Client\Resources;

use HMCSW4\Client\HMCSW4;

class Resource
{
  protected $HMCSW4;

  public function __construct($HMCSW)
  {

    $this->HMCSW4 = $HMCSW;
  }

}