<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\examples;

use axy\nginx\config\builder\MainContext;

require_once __DIR__ . '/../index.php';

$main = new MainContext();
$main->user->set('www', 'www');
$main->http->include('/etc/nginx/conf.d/*.conf');
$main->http->server('example.com');

echo $main->render();
