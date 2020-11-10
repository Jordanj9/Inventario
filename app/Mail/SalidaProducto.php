<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SalidaProducto extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $mensaje)
    {
        $this->subject = $subject;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.template.salida')->subject($this->subject)->with('mensaje', $this->mensaje);
    }
}
