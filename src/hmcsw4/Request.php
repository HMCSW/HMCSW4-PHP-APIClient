<?php

namespace HMCSW4\Client;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use http\Exception\BadConversionException;
use HMCSW4\Client\Exceptions\NotFoundException;
use HMCSW4\Client\Exceptions\BadRequestException;
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

  public function post($uri, array $query = [], array $payload = [], array $formParams = [])
  {
    return $this->request('POST', $uri, $query, $payload, $formParams);
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

  public function request($method, $uri, array $query = [], array $payload = [], array $formParams = [])
  {
    $uri = $this->serverUrl.'/v1/'.$uri;

    $body = json_encode($payload);

    $token = $this->apiKey;

    $options['form_params'] = $formParams;
    $options['query'] = $query;
    $options['body'] = $body;
    $options['headers']['Authorization'] = 'Bearer '.$token;

    $response = $this->guzzle->request($method, $uri, $options);

    if ($response->getStatusCode() != 200) {
      $this->handleRequestError($response);
    }

    $responseBody = (string) $response->getBody();

    $response = json_decode($responseBody, true);
    if(!$response['success']){
      throw new UnknownErrorException($response['response']['error_message'], $response['response']['error_code']);
    }
    return $response['response'];
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
    if($this->isJson($response->getBody())){
      $body = json_decode($response->getBody(), true);
      switch ($response->getStatusCode()) {
        case 404:
          throw new NotFoundException($body['response']['error_message'], $body['response']['error_code']);
        case 400:
          throw new BadRequestException($body['response']['error_message'], $body['response']['error_code']);
        default:
          throw new UnknownErrorException($body['response']['error_message'], $body['response']['error_code']);
      }
    } else {
      throw new UnknownErrorException($response->getBody(), $response->getStatusCode());
    }

  }

  public function isJson(string $json){
    json_decode($json);
    return json_last_error() === JSON_ERROR_NONE;
  }

}