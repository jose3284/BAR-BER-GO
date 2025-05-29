<?php

namespace App\Providers;
use App\Services\Cita\Interfaces\CitaServiceInterface;
use App\Services\Cita\CitaService;
use App\Services\Categoria\CategoriaService;
use App\Services\Categoria\Interfaces\CategoriaServiceInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CitaServiceInterface::class, CitaService::class);
        $this->app->bind(CategoriaServiceInterface::class, CategoriaService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
