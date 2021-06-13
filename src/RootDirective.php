<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\DirectiveSingleParam;

class RootDirective extends DirectiveSingleParam
{
    protected string $name = 'root';
}
