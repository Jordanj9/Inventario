<?php


namespace Src\Inventario\Shared\Domain;


interface IUnitOfWork
{
    public function beginTransaction(): void;

    public function commit(): void;

    public function rollback(): void;
}
