<?php
namespace App\Http\Services;
// andy-shi88: used a modified version of firebase/jwt. reason: it support jwk to pem conversion
use \Firebase\JWT\JWT;
use \Firebase\JWT\JWK;

class CognitoService {
  // cognito has a pair of public key can be used to validate the access token
  // only one of them will be used, need to check the kid before converting the jwk to pem
  // get the following from: https://cognito-idp.[region].amazonaws.com/[userPoolClientId]/.well-known/jwks.json
  private $publicKey = [
    "keys" => [
        [
          "alg" => "RS256",
          "e" => "AQAB",
          "kid" => "4hoahyHOuAAhiNZYisF5IQbbhvwzguCYj5s8QG+AQrM=",
          "kty" => "RSA",
          "n" => "q7Jt34NN8RRHwh8x96cIlUPtGMdT1AyqEC0KVadhOPtsrOb8IyzWEw0lpzbLBAj2ZPvv_PJhF6--oa5_Ak0pYkNOE_g-Wl1EUFB2Z_wMPmRMtLOuY6kNEHwOrmirwe1Y9584qnlN6-uKrTtK4tjvk9WNXAFpSeBpekOSfNYXyYIeTO2yZXL4NiOyn-2oom_1hd70SjmrGJB6gBfU9f8q9B-KG3R1GQZ0mnJD2yLJkcMkN2gDFHT9CwBIhb_MOP8hZqwI5bcdilvHHOrsoST9FDnEW3n-RUOuCBv5ziwufufjc14YFuRI7Zzk43_eMxfb-EPdjzh79VJQN6iNdIr1cw",
          "use" => "sig"
        ],
        [
          "alg" => "RS256",
          "e" => "AQAB",
          "kid" => "KuWA0n0BzVVJHKKP8P3bdXH9PO+leda0HwV6h4EvzxI=",
          "kty" => "RSA",
          "n" => "ofG1ux9ePtjnZvkK6AF2bgTRgcgD_yCWYCAjKNIPCXL2pPjNX95Bxx7rsGwVP3C58ZAwhPLLwNqCaYZ68VVwpq2hoVNKd5lEhijtQsNr41PY5ocZsUQSCDVzhfH2qsJUi8VNQSRzuW17BR8r0wEjOK4YOk8AM90bBr7axoC3Qz7JbWvBWAdUjjZrxhbfiZSetwbzw-eqBf5MZ_PAbTHEHZ_3giLxbndQq3hMBzQLCI5q-s4sWngVbG6pxeo-0WtXTtPvhv35PyreqC0fQ21tGcdcksNqzWR-THuu7ZK5irY7cjdnUp5qsIseR1oNghBxKhBuU_jd-RKFNaDVToyZkw",
          "use" => "sig"
        ]
      ]
  ];

  /**
   * Construct the service class
   */
  public function __construct() {
  }

  /**
   * verifyAccessToken verify given access token
   * @param $accessToken String
   * @return object decoded token
   */
  public function verifyAccessToken(String $accessToken) {
    $header = explode(".", $accessToken);
    $decodedHeader = json_decode(base64_decode($header[0]), true);
    $JWK = [];
    // find the right rsa key
    foreach($this->publicKey['keys'] as $key) {
      if ($key['kid'] == $decodedHeader['kid']) {
        $JWK = $key;
        break;
      }
    }
    try {
      $pem = JWK::parseKey($JWK);
      $decodeToken = JWT::decode($accessToken, $pem, array('RS256'));
      return $decodeToken;
    } catch(\Firebase\JWT\ExpiredException $e) {
      \Log::warning('token expired: ' . $e);
      return null;
    } catch (\Exception $e) {
      \Log::warning('fail to verify token: ' . $e);
      return null;
    }
  }

}