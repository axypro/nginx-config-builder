<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use axy\nginx\config\builder\SiteContext;

class ServerNameDirectiveTest extends BaseTestCase
{
    public function testToString(): void
    {
        $file = new SiteContext();
        $server = $file->server('example.com');
        $server->listen->disable();
        $sn = $server->serverName;
        $sn->comment->set('host name');
        $this->assertRenders([
            'server {',
            "\t# host name",
            "\tserver_name example.com;",
            '}',
        ], $file);
        $sn->comment->delete();
        $this->assertSame('server_name example.com;', (string)$sn);
        $sn->add(['www.example.com', 'www2.example.com']);
        $this->assertSame('server_name example.com www.example.com www2.example.com;', (string)$sn);
        $sn->set(null);
        $sn->comment->set('host name');
        $this->assertRenders([
            'server {',
            '}',
        ], $file);
    }
}
