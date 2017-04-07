<?php

namespace MScharl\LaravelStaticImageCache\Classes;

use GuzzleHttp\Client;

class ImageProxy
{
    private $enabled;

    function __construct()
    {
        if(config('static-image-cache.enabled') === 'debug') {
            $this->enabled = !config('app.debug');
        } else {
            $this->enabled = config('static-image-cache.enabled');
        }
    }

    /**
     * @param string $url
     * @return string
     */
    public function getUrl(string $url): string
    {
        if (!$this->enabled) {
            return $url;
        }
        // split the url into its parts
        $parts = parse_url($url);

        // collect the slug parts
        $slug = collect([]);
        // first use the host
        $slug->push($parts['host']);
        // extract the uri directory path
        $slug->push(dirname($parts['path']));

        // if available extract the query
        if (isset($parts['query'])) {
            $slug->push("q64_" . base64_encode($parts['query']));
        }

        // add the filename
        $slug->push(basename($parts['path']));


        $slug = $slug
            // remove slashed at the beginning and end of the string
            ->map(function (string $part) {
                return trim($part, '/');
            })
            // create an uri
            ->implode('/');

        // create the laravel route
        return route('static-image-cache.image-proxy', ['slug' => $slug]);
    }

    public function getOriginalUrl(string $uri): string
    {
        $matches = [];
        // extract the url parts from the uri
        preg_match('#^((?:.(?!q64_))+)(?:\/q64_([^\/]+))?\/(.+)$#', $uri, $matches);

        $url = "https://" . $matches[1];
        $url .= '/' . $matches[3];

        if (!empty($matches[2])) {
            $url .= '?' . base64_decode($matches[2]);
        }

        return $url;
    }

    /**
     * @param string $url
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function downloadImage(string $url): \Psr\Http\Message\ResponseInterface
    {
        $client = new Client();
        return $client->get($url);
    }

    /**
     * @param string $uri
     * @return \Illuminate\Http\Response
     */
    public function getImageResponse(string $uri): \Illuminate\Http\Response
    {
        $url = $this->getOriginalUrl($uri);

        $response = $this->downloadImage($url);

        return response((string)$response->getBody(), $response->getStatusCode(), $response->getHeaders());
    }
}
