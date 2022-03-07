<?php

namespace HMCSW4\Client;

use GuzzleHttp\Client as Client;

class HMCSW4
{
  public string $serverUrl;
  public string $apiKey;
  public Request $request;

  public function __construct($serverUrl, $apiKey, Client $guzzle = null)
  {
    $this->serverUrl = $serverUrl;

    $this->apiKey = $apiKey;

    $this->request = new Request($this, $guzzle);
  }

  public function getRequest(): Request
  {
    return $this->request;
  }

  public function getService(int $team_id, int $service_id): Resources\Service
  {
    return new Resources\Service($this, $team_id, $service_id);
  }



}