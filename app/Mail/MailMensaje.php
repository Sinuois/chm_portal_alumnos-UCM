<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailMensaje extends Mailable
{
    use Queueable, SerializesModels;
    public $mensaje;

    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
    }
    public function build()
    {
        return $this->subject('Mensaje de Portal UCM')->view('mails.mailmensaje');
    }
}
