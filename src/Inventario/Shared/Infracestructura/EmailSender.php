<?php


namespace Src\Inventario\Shared\Infracestructura;


use App\Mail\SalidaProducto;
use Illuminate\Support\Facades\Mail;
use Src\Inventario\Shared\Domain\IEmailSender;

class EmailSender implements IEmailSender
{

    public function enviarEmail(string $email, string $subject, string $mensaje): void
    {
        Mail::to($email)->send(new SalidaProducto($subject,$mensaje));
    }
}
