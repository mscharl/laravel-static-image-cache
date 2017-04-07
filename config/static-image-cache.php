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
    | Cache path prefix
    |--------------------------------------------------------------------------
    |
    | The path prefix relative to `public_path`. This is where the images will
    | be stored. This path will also be used as the proxy-url prefix.
    */

    'cache_path_prefix' => 'cache/images',
];
