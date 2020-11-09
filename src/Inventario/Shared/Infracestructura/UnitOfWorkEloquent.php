<?php


namespace Src\Inventario\Shared\Infracestructura;


use Illuminate\Support\Facades\DB;
use Src\Inventario\Shared\Domain\IUnitOfWork;

class UnitOfWorkEloquent implements IUnitOfWork
{

    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    public function commit(): void
    {
        DB::commit();
    }

    public function rollback(): void
    {
        DB::rollBack();
    }
}
