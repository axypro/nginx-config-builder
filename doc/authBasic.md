# Auth Basic

All [block directives](block.md) contains the public property `$authBasic`.
It is disabled by default.

```php
$server->authBasic->on('/var/www/.htpasswd', 'Password, please');
```

Leads to

```
auth_basic "Password, please";
auth_basic_user_file /var/www/.htpasswd;
```

```php
$server->authBasic->off();
```

Leads to

```
auth_basic off;
```
