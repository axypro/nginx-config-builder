<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use axy\nginx\config\builder\LocationDirective;

class LocationDirectiveTest extends BaseTestCase
{
    public function testToString(): void
    {
        $location = new LocationDirective();
        $location->exact('/');
        $this->assertRenders("location = / {\n}", $location);
        $location->prefix('/test');
        $this->assertRenders("location /test {\n}", $location);
        $location->prefix('/test', true);
        $this->assertRenders("location ^~ /test {\n}", $location);
        $location->reg('\.png$');
        $this->assertRenders("location ~ \.png$ {\n}", $location);
        $location->reg('\.pn g$', true);
        $this->assertRenders("location ~* \.pn\ g$ {\n}", $location);
        $location->named('test');
        $this->assertRenders("location @test {\n}", $location);
        $location->location('/')->comment->set('Nested');
        $this->assertRenders(implode("\n", [
            'location @test {',
            "\t# Nested",
            "\tlocation / {",
            "\t}",
            '}',
        ]), (string)$location);
    }
}
