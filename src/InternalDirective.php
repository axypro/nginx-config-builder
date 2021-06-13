<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\DirectiveWithoutParams;

class InternalDirective extends DirectiveWithoutParams
{
    protected string $name = 'internal';
}
