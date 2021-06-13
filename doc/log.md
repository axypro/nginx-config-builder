# Log

There are classes `AccessLogDirective` and `ErrorLogDirective`.
The class `LogDirectives` contains information about both log.

## `LogDirectives`

[ServerDirective](server.md) contain property `log` of the `LogDirectives` class.
Also, you can create an instance of log and add to any block directive.

By default, logs are in "default" mode.
They are not displayed and nginx will take values from parent contexts.

You can enable it:

```php
$server->log->on('/var/log/nginx/');
```

```
server {
    access_log /var/log/nginx/access.log;
    error_log /var/log/nginx/error.log;
}
```

Or

```php
$server->log->on('/var/log/nginx/example.com.');
```

```
server {
    access_log /var/log/nginx/example.com.access.log;
    error_log /var/log/nginx/example.com.error.log;
}
```

Or disable:

```php
$server->log->off();
```

```
server {
    access_log off;
    error_log /dev/null;
}
```

Or return to default state: `$server->log->toDefault()`.

Log instance contains properties `$access` and `$error` and you can work with logs separately.

```php
$server->log->error->off();
$server->log->access->on('/var/log/access.log');
$server->log->access->format = 'main';
$server->log->access->buffer = '5M';
$server->log->access->gzip = true;
$server->log->access->flush = null;
$server->log->access->if = null;
```

```
server {
    access_log /var/log/access.log main buffer=5M gzip;
    error_log /dev/null;
}
```

## Log formats

[http](http.md) contains property `logFormats`.

```php
$http->logFormats->set('main', '$remote_addr - $status');
$http->logFormats->set('custom', '$remote_addr - $byte_send', 'json');
$http->logFormats->delete('combined');
```

```
http {
    log_format main '$remote_addr - $status';
    log_format custom escape=json '$remote_addr - $byte_send';
}
```


