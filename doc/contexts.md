# File contexts

* `Context` (axy\nginx\config\syntax)
    * `FileContext`
        * `MainContext`
        * `SiteContext`

## `MainContext`

Top level context.
Usually used in the main config file (`/etc/nginx/nginx.conf`).
Contains top level directives as [http](http.md), `user`, etc.

```php
use axy\nginx\config\builder\MainContext;

$main = new MainContext();
$main->user->set('www', 'www');
$main->http->include('/etc/nginx/conf.d/*.conf');
$main->http->server('example.com');

echo $main->render();
```

Output:

```
user www www;
http {
    include /etc/nginx/conf.d/*.conf;
    server {
        server_name example.com;
        listen 80;
    }
}
```

## `SiteContext`

Context of a file from `/etc/nginx/conf.d` or `/etc/nginx/sites-enabled` that described one or more sites.
Contains `server {}` directives.

```php
use axy\nginx\config\builder\SiteContext;

$site = new SiteContext();
$server = $site->server('example.com');
$server->root->set('/var/www/html');
$server->listen->isDefault = true;
$site->server('www.example.com')->redirectServerTo('http://example.com');

echo $site->render();
```

Output:

```
server {
    root /var/www/html;
    server_name example.com;
    listen 80 default_server;
}
server {
    server_name www.example.com;
    listen 80;
    location / {
        return 301 http://example.com$request_uri;
    }
}
```
