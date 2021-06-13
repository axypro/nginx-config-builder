# `location`

The class `LocationDirective` implements the `location` directive.

## Constructor

* `__construct(?string $uri = null, ?string $modifier = null)`
* `$server->location([$uri, [$modifier]]): LocationDirective` - creates `location` inside a `server`
* `$location->location([$uri, [$modifier]]): LocationDirective` - creates nested `location`

## Matches

```php
$location->exact('/robots.txt'); // location = /robots.txt
$location->prefix('/images'); // location /images
$location->prefix('/images', reg: true); // location ^~ /images
$location->reg('\.png$'); // location ~ \.png
$location->reg('\.png$', ci: true); // location ~* \.png
$location->named('name'); // location @name
```

## Internal

```php
$location->internal->enable(); // location {internal; ... }
```

## Methods

* `location([$uri, [$modifier]]): LocationDirective` - creates nested `location`
* `if(string $condition = ''): IfDirective` - creates `if` directive
* `return(?int $code = null, ?string $url = null, ?string $text = null): SingleDirective` - creates return

```php
$site
    ->server()
    ->location('/')
    ->location('/dir')
    ->if('$slow')
    ->return(402);
```

```
server {
    location / {
        location /dir {
            if ($slow) {
                return 402;
            }
        }
    }
}
```
