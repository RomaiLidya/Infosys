<?php
namespace App\Hady\Mails;

use Illuminate\Support\Facades\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class HadyMail extends Mailable
{
    use Queueable, SerializesModels;

    abstract public function getData();

    abstract public function getView();

    abstract public function getEmail();

    abstract public function getSubject();

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('orenda.dev@gmail.com')
            ->view($this->getView())
            ->with($this->getData())
            ->subject($this->getSubject());
    }

    public function sendMail()
    {
        Mail::to($this->getEmail())->send($this);
    }
}
