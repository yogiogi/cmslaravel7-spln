<?php
namespace App\Helper\Helper;

function generateRandomString($length = 25) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
    //usage 

     function unique_code($limit)
    {
      return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
