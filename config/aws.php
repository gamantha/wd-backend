<?php

// store aws configuration
return [
  'COGNITO' => [
    'USER_POOL_ID' => env('COGNITO_USER_POOL_ID'),
    'CLIENT_ID' => env('COGNITO_CLIENT_ID'),
    'REGION' => env('COGNITO_REGION')
  ],
];