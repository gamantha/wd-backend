<?php 

namespace App\Http\Errors;

/**
 * Cognito Error code constants
 */
class CognitoErrors {
  static public $TokenNotProvided = "CognitoError:TokenNotProvided";
  static public $TokenInvalid = "CognitoError:TokenInvalid";
  static public $TokenExpired = "CognitoError:TokenExpired";
}
