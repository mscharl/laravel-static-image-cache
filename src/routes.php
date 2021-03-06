<?php

Route::group(['prefix' => config('static-image-cache.cache_path_prefix'), 'namespace' => 'MScharl\LaravelStaticImageCache\Http\Controllers'], function () {
    Route::get('/{slug}', ['as' => 'static-image-cache.image-proxy', 'uses' => 'ProxyController@image'])
        ->where('slug', '.*')
        ->middleware(\MScharl\LaravelStaticImageCache\Http\Middleware\LaravelStaticImageCacheMiddleware::class);
});
