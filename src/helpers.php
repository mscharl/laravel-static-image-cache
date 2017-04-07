<?php

if (!function_exists('staticImage')) {
    /**
     * @param string $url
     * @return string
     */
    function staticImage(string $url): string
    {
        return app('static-image-cache')->getUrl($url);
    }
}
