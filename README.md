# laravel-static-image-cache
> store/cache external images as a static file

## Setup

Add the service provider to the `app.php` provider array
```php
[
    MScharl\LaravelStaticImageCache\Provider\LaravelStaticImageCacheProvider::class,
]
```

Add this snippet to your .htaccess 
```apacheconfig
RewriteEngine On

# Rewrite to image cache if it exists
RewriteCond %{DOCUMENT_ROOT}/cache%{REQUEST_URI} -f
RewriteRule ^(.*)$ /cache%{REQUEST_URI} [L]
```


## Usage
Just use the `staticImage`-helper to generate the static file url

```blade
<img src="{{ staticImage('https://images.domain.com/my-image.jpg') }}" alt="An external image">
```

