<?php

use App\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($otentikasiHeader)
{
  if (is_null($otentikasiHeader)) {
    throw new Exception("Token Required!");
  }
  return explode(" ", $otentikasiHeader)[1];
}

function validateJWT($encodedToken)
{
  $session = \Config\Services::session();
  $key = getenv("JWT_SECRET_KEY");
  $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
  // $modelOtentikasi = new UserModel();
  // return $modelOtentikasi->where('id_user', $decodedToken->user)->findAll();
  return $session->setFlashData('user', $decodedToken->user);
}

function createJWT($id)
{
  $waktuRequest = time();
  $waktuToken = getenv("JWT_TIME_TO_LIVE");
  $waktuExpired = $waktuRequest + $waktuToken;
  $payload = [
    "user" => $id,
    "iat" => $waktuRequest,
    "exp" => $waktuExpired
  ];
  $jwt = JWT::encode($payload, getenv("JWT_SECRET_KEY"), "HS256");
  return $jwt;
}
