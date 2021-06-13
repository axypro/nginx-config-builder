# List of single directive classes

The library doesn't contain classes for all nginx directives.
You can add any directive or content manually:

```php
$server->context->single('my_directive', ['param1', 'param2']);
$server->context->append('just a text');
```

* [access_log, error_log & log_format](log.md)
* [server_name, listen, root, index](server.md)
* internal - part of [location](location.md), can be only enabled or disabled.
* [auth_basic](authBasic.md)
* try_files
* user - part of [main context](contexts.md)
