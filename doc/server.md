# `server`

The class `ServerDirective` implements the `server` directive.

## Constructor

* `new ServerDirective([string|array|null $name])`
    * `$name` is the server name
* [SiteContext](contexts.md)->server([$name]) - creates a server inside site context
* [http](http.md)->server([$name]) - creates a server inside `http` directive

## Properties

Has predefined nested directives: `$listen`, `$serverName`, `$index`, [$log](log.md).

### `listen`

The only directive that displayed by default (`listen 80`).

Public properties:

* `?string $port = null`
* `?string $address = null`
* `?string $socket = null`
* `bool $isDefault = false`
* `bool $isSSL = false`
* `array $additional = []`

If the port is not specified it will be defined by `isSSL`.

```php
$server->listen->isSSL = true;
$server->listen->isDefault = true;
$server->listen->additional['deferred'] = true;
$server->listen->additional['ipv6only'] = 'off';
```

```
server {
    listen 443 default_server ssl deferred ipv6only=off;
}
```

If the directive is not needed: `$server->listen->disabled()`.
If you need multiple `listen` directives add these manually.

### `server_name`

The server name takes from the server constructor.
It can contain one name, or a list of names.
If the list is empty the directive is disabled.

```php
$site = new SiteContext();
$server = $site->server('example.com');

$server->serverName->add('www.example.com');

echo $server->render();
```

```
server {
    server_name example.com www.example.com;
}
```

### index

Public property of [block directives](block.md) (http, server, location).
List of files is empty by default and the directive is hidden.

```php
$server->index->set('index.php');
$server->index->add('index.html');
```

## Methods

* Inherited from [basic classes](block.md)
    * `location(?string $uri = null, ?string $modifier = null): LocationDirective` - creates [location](location.md) block
    * `if(string $condition = ''): IfDirective` - creates [if](if.md) block
    * `return(?int $code = null, ?string $url = null, ?string $text = null): SingleDirective` - creates return directive
    * `denyAll()` - set `deny all` for the server
* `fpm()` - creates [FPM location](fastcgi.md)
* `redirectServerTo(string $target)` - redirect from this host to a base host

```php
echo $site->server('www.example.com')->redirectServerTo('example.com')->render();
```

```
server {
    server_name www.example.com;
    listen 80;
    location / {
        return 301 example.com$request_uri;
    }
}
```
