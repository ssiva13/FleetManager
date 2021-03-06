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
	    if ($this->app->environment() == 'local') {
		    $this->app->register(\KitLoong\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
		    $this->app->register(\Krlove\EloquentModelGenerator\Provider\GeneratorServiceProvider::class);
		    $this->app->register(\Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);
	    }
    }
}
