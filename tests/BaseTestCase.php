<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use axy\pkg\unit\BaseAxyTestCase;

abstract class BaseTestCase extends BaseAxyTestCase
{
    public function assertRenders(string|array|null $expected, mixed $item): void
    {
        if ($expected === null) {
            $expected = '';
        } elseif (is_array($expected)) {
            $expected = implode("\n", $expected);
        }
        $this->assertSame($expected, (string)$item);
    }
}
