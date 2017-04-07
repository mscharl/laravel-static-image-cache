<?php

namespace MScharl\LaravelStaticImageCache\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProxyController extends Controller
{
    public function image(Request $request) {
        $route = $request->route();
        $slug = $route->parameter('slug');

        return app('static-image-cache')->getImageResponse($slug);
    }
}
