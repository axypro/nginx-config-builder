<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\DirectiveMultiParams;

class ServerNameDirective extends DirectiveMultiParams
{
    protected string $name = 'server_name';
}
