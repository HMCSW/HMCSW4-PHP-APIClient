<?php

namespace HMCSW4\Client;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use HMCSW4\Client\Exceptions\notFoundException;
use HMCSW4\Client\Exceptions\UnknownErrorException;

class Request
{
  private HMCSW4 $HMCSW4;
  private string $serverUrl;
  private string $apiKey;
  private int $timeout = 30;
  private Client $guzzle;

  public function __construct(HMCSW4 $HMCSW4, Client $guzzle = null)
  {
    $this->HMCSW4 = $HMCSW4;

    $this->serverUrl = $this->HMCSW4->serverUrl;
    $this->apiKey = $this->HMCSW4->apiKey;

    $this->guzzle = $guzzle ?: new Client([
      'base_uri'    => $this->serverUrl,
      'http_errors' => false,
      'headers'     => [
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json',
      ],
    ]);

    return $this;
  }

  public function get($uri, array $query = [])
  {
    return $this->request('GET', $uri, $query);
  }

  public function post($uri, array $query = [], array $payload = [])
  {
    return $this->request('POST', $uri, $query, $payload);
  }

  public function put($uri, array $query = [], array $payload = [])
  {
    return $this->request('PUT', $uri, $query, $payload);
  }

  public function patch($uri, array $query = [], array $payload = [])
  {
    return $this->request('PATCH', $uri, $query, $payload);
  }

  public function delete($uri, array $query = [], array $payload = [])
  {
    return $this->request('DELETE', $uri, $query, $payload);
  }

  public function request($method, $uri, array $query = [], array $payload = [])
  {
    $uri = $this->serverUrl.'/v1/'.$uri;

    $body = json_encode($payload);

    $token = $this->apiKey;

    $options['query'] = $query;
    $options['body'] = $body;
    $options['headers']['Authorization'] = 'Bearer '.$token;

    $response = $this->guzzle->request($method, $uri, $options);

    if ($response->getStatusCode() != 200) {
      $this->handleRequestError($response);
    }

    $responseBody = (string) $response->getBody();

    return json_decode($responseBody, true);
  }



  /**
   * @param ResponseInterface $response
   *
   * @return void
   * @throws notFoundException
   * @throws UnknownErrorException
   */
  private function handleRequestError(ResponseInterface $response)
  {
    switch ($response->getStatusCode()) {
      case 404:
        throw new NotFoundException($response->getBody(), 404);
      default:
        throw new UnknownErrorException($response->getBody(), $response->getStatusCode());
    }
  }

}