<?php

namespace MScharl\LaravelStaticImageCache\Provider;

use Illuminate\Support\ServiceProvider;
use MScharl\LaravelStaticImageCache\Classes\ImageProxy;
use MScharl\LaravelStaticImageCache\Commands\ClearStaticCache;

class LaravelStaticImageCacheProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        $this->publishes([
            __DIR__.'/../../config/static-image-cache.php' => config_path('static-image-cache.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/static-image-cache.php', 'static-image-cache');

        $this->app->singleton('static-image-cache', function() {
            return new ImageProxy();
        });

        $this->commands([
            ClearStaticCache::class,
        ]);
    }

    public function provides()
    {
        return [
            'static-image-cache'
        ];
    }
}
