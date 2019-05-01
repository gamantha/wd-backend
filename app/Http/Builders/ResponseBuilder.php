<?php 

namespace App\Http\Builders;

/**
 * ResponseBuilder build response object
 */
class ResponseBuilder {

  private $response;

  // http status code
  private $status = 200;

  private $headers = [
    'Content-Type' => 'application/json'
  ];

  public function __construct() {
    $this->response = new Response();
  }

  public function setMessage($message) {
    $this->response->setMessage($message);
    return $this;
  }

  public function setSuccess($success) {
    $this->response->setSuccess($success);
    return $this;
  }

  public function setData($data) {
    $this->response->setData($data);
    return $this;
  }

  public function setTotal($total) {
    $this->response->setTotal($total);
    return $this;
  }

  public function setCount($count) {
    $this->response->setCount($count);
    return $this;
  }

  public function setPage($page) {
    $this->response->setPage($page);
    return $this;
  }
  
  public function addError($error) {
    $this->response->addError($error);
    return $this;
  }

  public function addHeader($header) {
    array_push($this->headers, $header);
    return $this;
  }

  public function setStatus($status) {
    $this->status = $status;
    return $this;
  }

  /**
   * build return the built response object
   */
  public function build() {
    $result = new \Illuminate\Http\Response($this->response->jsonSerialize(), $this->status);
    return $result->withHeaders($this->headers);
  }
}