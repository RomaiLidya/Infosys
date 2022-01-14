<?php
namespace App\Hady\Mails;

use App\Hady\Mails\HadyMail;

// Forgot password confirmation to member
class ForgotPassword extends HadyMail
{
    private $link;
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getData() {
        return [
            'user' => $this->user,
            'link' => $this->link,
        ];
    }

    public function getEmail() {
        return $this->user->email;
    }

    public function getView() {
        return 'emails.forgot-password';
    }

    public function getSubject()
    {
        return '[Reset] Permintaan reset Password';
    }
}
