<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Inventario\Domain\IProductosimpleRepository;
use Src\Inventario\Infraestructura\Persistencia\ProductosimpleEloquentRepository;

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
