<?php


namespace Src\Inventario\Shared\Domain;


interface IEmailSender
{
    public function enviarEmail(string $email, string $subject, string $mensaje): void;
}
