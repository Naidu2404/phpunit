<?php

class User
{
    public $first_name;
    public $surname;

    public $email;

    protected $mailer;

    public function setMailer(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function getFullName()
    {
        return trim("$this->first_name $this->surname");
    }

    //we use the mailer here
    public function notify($message)
    {

        return $this->mailer->sendMessage($this->email, $message);
        // return true;
    }
}
