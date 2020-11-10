<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use L5Swagger\L5SwaggerServiceProvider;
use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Infraestructura\Persistencia\ProductosimpleEloquentRepository;
use Src\Inventario\Shared\Domain\IEmailSender;
use Src\Inventario\Shared\Domain\IUnitOfWork;
use Src\Inventario\Shared\Infracestructura\EmailSender;
use Src\Inventario\Shared\Infracestructura\UnitOfWorkEloquent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IProductosimpleRepository::class, ProductosimpleEloquentRepository::class);
        $this->app->bind(IUnitOfWork::class, UnitOfWorkEloquent::class);
        $this->app->bind(IEmailSender::class, EmailSender::class);
        $this->app->register(L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
