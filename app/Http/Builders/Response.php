<?php

namespace App\Http\Builders;

/**
 * Response class to store response to api call
 */
class Response {

  private $meta = [
    'message' => 'api call success',
    'success' => false,
    'errors' => [],
  ];

  private $data = [];

  private $links = null;

  public function __construct() {

  }

  public function setMessage($message) {
    $this->meta['message'] = $message;
  }

  public function setSuccess($success) {
    $this->meta['success'] = $success;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function setTotal($total) {
    $this->links['total'] = $total;
  }

  public function setCount($count) {
    $this->links['count'] = $count;
  }

  public function addError($error) {
    array_push($this->meta['errors'], $error);
  }

  public function jsonSerialize() {
    return [
        'meta' => $this->meta,
        'data' => $this->data,
        'links' => $this->links,
    ];
}

}
