<?php

namespace MScharl\LaravelStaticImageCache\Http\Middleware;

use Closure;
use Illuminate\Filesystem\Filesystem;

class LaravelStaticImageCacheMiddleware
{

    /**
     * @var Filesystem
     */
    private $files;

    function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(\Illuminate\Http\Request $request, \Illuminate\Http\Response $response)
    {
        if ($response->isOk()) {
            $filename = $request->route('slug');
            $filename = public_path(config('static-image-cache.cache_path_prefix') . "/" . $filename);

            $file = $response->getContent();
            $path = dirname($filename);

            if (!$this->files->isDirectory($path)) {
                $this->files->makeDirectory($path, 0777, true);
            }

            $this->files->put($filename, $file);
        }
    }
}
