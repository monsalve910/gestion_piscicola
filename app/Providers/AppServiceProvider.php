<?php

namespace App\Providers;

use App\Contracts\ParametrosEspecieProvider;
use App\Services\ParametrosEspecieNulo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ParametrosEspecieProvider::class, ParametrosEspecieNulo::class);
    }

    public function boot(): void
    {
        //
    }
}
