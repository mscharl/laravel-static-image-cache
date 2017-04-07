<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable static proxy
    |--------------------------------------------------------------------------
    |
    | If `true` the package will proxy and store the images
    | If `false` the package will do nothing and the real images will be loaded
    |
    | If `debug` the package will synchronise the flag with the `app.debug`
    | config value
    */

    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Cache route prefix
    |--------------------------------------------------------------------------
    |
    | The route prefix to use for the proxy route. Changing this will also
    | require to update your .htaccess config.
    */

    'image_route_prefix' => 'image',

    /*
    |--------------------------------------------------------------------------
    | Cache path prefix
    |--------------------------------------------------------------------------
    |
    | The path prefix relative to `public_path`. This is where the images will
    | be stored.
    | Changing this will also require to update your .htaccess config.
    */

    'cache_path_prefix' => 'cache/image',

];
