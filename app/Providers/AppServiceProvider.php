<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->register(\Krlove\EloquentModelGenerator\Provider\GeneratorServiceProvider::class);
        // $app->register(\KitLoong\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);


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
