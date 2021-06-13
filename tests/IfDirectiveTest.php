<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use axy\nginx\config\builder\IfDirective;

class IfDirectiveTest extends BaseTestCase
{
    public function testToString(): void
    {
        $if = new IfDirective('$request_method = POST');
        $if->context->comment->set('If request method is POST');
        $if->context->single('return', '405');
        $this->assertRenders([
            'if ($request_method = POST) {',
            "\t# If request method is POST",
            "\treturn 405;",
            '}',
        ], $if);
    }
}
