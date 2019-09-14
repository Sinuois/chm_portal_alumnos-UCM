<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailMensaje extends Mailable
{
    use Queueable, SerializesModels;

    //public $correo;

    public function __construct() //public function __construct(Correo $correo)
    {
        //$this->correo = $correo;
    }
    public function build()
    {
        return $this->subject('Mensaje de secretaría')->view('mails.mailmensaje');
    }
}
