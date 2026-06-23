<?php

namespace App\Providers;

use App\Contracts\ParametrosEspecieProvider;
use App\Services\ParametrosEspecieDesdeEspecie;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ParametrosEspecieProvider::class, ParametrosEspecieDesdeEspecie::class);
    }

    public function boot(): void
    {
        //
    }
}
