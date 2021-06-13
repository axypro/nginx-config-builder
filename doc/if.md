# `if`

The class `IfDirective` implements the `if` directive.
By [inheritance](block.md) this class can have features that `if` directive doesn't have in nginx.

## Constructor

* `__construct(public string $condition = '')`
    * `$condition` if just a string
* `$server->if([$condition])` - creates `if` inside a `server`
* `$location->if([$condition])` - creates `if` inside a `location`

```php
$site->server()->if('$request_method = POST')->return(405);
```

```
server {
    if ($request_method = POST) {
        return 405;
    }
}
```
