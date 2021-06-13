<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use axy\nginx\config\builder\LogDirectives;

class LogDirectivesTest extends BaseTestCase
{
    public function testToString(): void
    {
        $log = new LogDirectives();
        $this->assertRenders(null, $log);
        $log->on('/var/log/nginx/site.');
        $this->assertRenders([
            'access_log /var/log/nginx/site.access.log;',
            'error_log /var/log/nginx/site.error.log;',
        ], $log);
        $log->access->format = 'main';
        $log->access->buffer = '5M';
        $log->access->gzip = true;
        $log->error->level = 'error';
        $this->assertRenders([
            'access_log /var/log/nginx/site.access.log main buffer=5M gzip;',
            'error_log /var/log/nginx/site.error.log error;',
        ], $log);
        $log->off();
        $this->assertRenders([
            'access_log off;',
            'error_log /dev/null;',
        ], $log);
        $log->toDefault();
        $this->assertRenders(null, $log);
    }
}
