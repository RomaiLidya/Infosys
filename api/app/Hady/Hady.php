<?php

namespace App\Hady;

use JWTAuth;
use Auth;
use App\Models\User;
use App\Hady\Mails\ForgotPassword;

class Hady
{
    public static function init()
    {
        $ds = DIRECTORY_SEPARATOR;
        $list = [
            $ds . 'tmp',
            $ds . 'assets',
            $ds . 'assets' . $ds . 'opname'
        ];

        foreach($list as $x) {
            // Check if $x folder is exists
            $path = public_path() . $x;
            if(!file_exists($path) && !mkdir($path, 0755, true)) {
                die('Cannot make ' . $path . ' folder');
            }
        }
    }

    public static function forgotPassword($loginName)
    {
        $user = User::where([['email', $loginName]])->first();

        if (!$user) {
            throw new \Exception("User: $loginName does not exists");
        }

        $myTTL = 30; //minutes
        JWTAuth::factory()->setTTL($myTTL);

        $token = JWTAuth::fromUser($user);

        $mail = new ForgotPassword($user);

        $resetPasswordLink = env('APP_URL').'/resetpassword?t=' . $token;

        $mail->setLink($resetPasswordLink);
        
        $mail->sendMail();

        return $token;
    }

    public static function login($email, $password)
    {
        if (!$token = JWTAuth::attempt(['email' => $email, 'password' => $password])) {
            throw new \Exception("Anda tidak memiliki akses untuk login!");
        }
        
        $user = Auth::user();
        return $user->generateApiToken($token);
    }

    public static function logout($token)
    {
        if(!empty($token)) {
            auth()->logout(true);

            return JWTAuth::parseToken()->invalidate($token);
        }

        throw new \Exception("Logout error");
    }

    public static function resetPassword($token, $newPassword)
    {
        if (!$newToken = JWTAuth::setToken($token)->getPayload()) {
            throw new \Exception("Anda tidak memiliki akses untuk login!");
        }

        $payload = JWTAuth::getPayload($newToken);

        $model = User::find($payload['sub']);
        $model->password = $newPassword;
        $model->save();
    }

    public static function getPaginate()
    {
        return 20;
    }

    public static function getDateFormat()
    {
        return 'd-m-Y';
    }
}
