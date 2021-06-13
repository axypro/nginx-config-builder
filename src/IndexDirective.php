<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\DirectiveMultiParams;

class IndexDirective extends DirectiveMultiParams
{
    protected string $name = 'index';
}
