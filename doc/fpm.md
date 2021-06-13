# FPM

There are

* `FPMDirectives` - block of fastcgi directives for FPM (child of [FastCGIDirectives](fastcgi.md))
* `FPMLocationDirective` - child of [LocationDirective](location.md)

There are two basic options for PHP integration.

First: process each of PHP file:

```
location ~ \.php$ {
    try_files $uri /index.php =404;
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_pass localhost:9000;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}
```

Second: intercept all requests to "pages":

```
# Request to resources, processed by nginx
location /images {
}

# Other requests are requests to pages and processed by PHP (index.php as entrypoint)
location / {
    fastcgi_pass   localhost:9000;
    include        fastcgi_params;
    fastcgi_param  SCRIPT_FILENAME $document_root/index.php;
}
```

## Create FPM location

```php
$server = $site->server('example.com');
$server->location('/images');
$fpmLocation = $server->fpm('/index.php');

echo $site->render();
```

```
server {
    server_name example.com;
    listen 80;
    location /images {
    }
    location / {
        fastcgi_pass localhost:9000;
        fastcgi_param SCRIPT_FILENAME $document_root/index.php;
        include fastcgi_params;
    }
}
```

The argument of `fpm()` is path to "entrypoint".
If it is NULL used variant without entrypoint (process any ".php" file).

You can change variant later: `$fpmLocation->setEntrypoint('/another.php)` or `$fpmLocation->setEntrypoint(null)`.

You can edit location.

```php
$fpmLocation->prefix('/admin');
$fpmLocation->setPass('php-fpm');
$fpmLocation->fpm->directives['read_timeout'] = 600;
$fpmLocation->append('additional_directive;');
```

```
server {
    server_name example.com;
    listen 80;
    location /images {
    }
    location /admin {
        fastcgi_read_timeout 600;
        fastcgi_pass php-fpm;
        fastcgi_param SCRIPT_FILENAME $document_root/index.php;
        include fastcgi_params;
        additional_directive;
    }
}
```

### FPMLocationDirective

Methods:

* `setEntrypoint(?string $entrypoint)` - change the entrypoint or disable it (switch to all PHP files process)
* `setPass(?string $pass)` - set proxy pass

Properties:

* `$fpm` (FPMDirectives)
* `$tryFiles` (TryFilesDirective) - disabled if the entripoint is used
