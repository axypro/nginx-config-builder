# `FastCGIDirectives`

It is a part of context with directives for FastCGI proxy.

Public properties:

* `$directives` (string[])
* `$pass` (?string)
* `$params` (string[])
* `$include` (string = "fastcgi_params)

```php
$fastCGI = new FastCGIDirectives();

$fastCGI->pass = 'localhost:8888';
$fastCGI->directives['pass_request_body'] = 'on';
$fastCGI->directives['pass_request_headers'] = 'on';
$fastCGI->params['QUERY_STRING'] = '$query_string';
$fastCGI->params['SCRIPT_FILENAME'] = '/var/www/index.php';

echo $fastCGI;
```

Output:

```
fastcgi_pass_request_body on;
fastcgi_pass_request_headers on;
fastcgi_pass localhost:8888;
fastcgi_param QUERY_STRING $query_string;
fastcgi_param SCRIPT_FILENAME /var/www/index.php;
include fastcgi_params;
```
