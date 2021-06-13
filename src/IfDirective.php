<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

class IfDirective extends LIDirective
{
    public function __construct(public string $condition = '')
    {
        parent::__construct();
    }

    public function getName(): string
    {
        return 'if';
    }

    public function getParams(): string|array|null
    {
        return "({$this->condition})";
    }
}
