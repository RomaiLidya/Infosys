<?php

namespace App\Orenda;

class AuthHelper
{
    public static function setCookie($string)
    {
        $expire = time() + (86400 * 30); // 1 day
        setcookie('api_token', $string, $expire, '/', env('APP_DOMAIN'));
        setcookie('api_token', $string, $expire, '/', env('APP_MOBILE_DOMAIN'));
    }
}
