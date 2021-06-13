<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use axy\nginx\config\builder\MainContext;

class MainContextTest extends BaseTestCase
{
    public function testRender(): void
    {
        $main = new MainContext();
        $main->user->set('www', 'www');
        $main->log->on('/var/log/nginx/');

        $server = $main->http->server('example.com');
        $server->log->on('/var/log/nginx/example.');
        $server->index->set(['index.html', 'index.php']);
        $server->listen->address = '127.0.0.1';
        $server->listen->isSSL = true;
        $server->listen->isDefault = true;
        $server->listen->additional['ipv6only'] = 'off';
        $server->listen->additional['deferred'] = true;
        $server->listen->additional['reuseport'] = false;
        $server->root->set('/var/www/html');
        $server->location('/.ht', '~')->denyAll();
        $server->authBasic->on('/var/www/.htpasswd', 'Password, please');
        $internal = $server->location('@name');
        $internal->internal->enable();
        $internal->root->set('/var/www/app');
        $internal->authBasic->off();

        $main->http->server('www.example.com')->redirectServerTo('https://example.com');

        $http = $main->http;
        $http->logFormats->set('main', '$status');
        $http->logFormats->set('custom', '$remote_addr - $status', 'json');
        $http->logFormats->set('another', '$status', 'json');
        $http->logFormats->delete('another');
        $http->include('/etc/nginx/conf.d/*.conf');

        $expected = rtrim(file_get_contents(__DIR__ . '/main.txt')) . "\n";
        $this->assertSame($expected, $main->render());
    }
}
