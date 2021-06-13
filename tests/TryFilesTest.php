<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use axy\nginx\config\builder\TryFilesDirective;

class TryFilesTest extends BaseTestCase
{
    public function testToString(): void
    {
        $tf = new TryFilesDirective('$uri', 404);
        $this->assertRenders('try_files $uri =404;', $tf);
        $tf->add('/index.php');
        $tf->code = 405;
        $this->assertRenders('try_files $uri /index.php =405;', $tf);
        $tf->set('/index.php');
        $tf->code = null;
        $this->assertRenders('try_files /index.php;', $tf);
    }
}
