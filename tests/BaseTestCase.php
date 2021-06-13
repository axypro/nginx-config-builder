<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    public function assertRenders(string|array|null $expected, $item): void
    {
        if ($expected === null) {
            $expected = '';
        } elseif (is_array($expected)) {
            $expected = implode("\n", $expected);
        }
        $this->assertSame($expected, (string)$item);
    }
}
