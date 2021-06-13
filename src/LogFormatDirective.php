<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\SingleDirective;

class LogFormatDirective extends SingleDirective
{
    public function __construct(public string $name, public string $format, public ?string $escape = null)
    {
        parent::__construct();
    }

    public function getName(): ?string
    {
        return 'log_format';
    }

    public function getParams(): string|array|null
    {
        $params = [$this->name];
        if ($this->escape !== null) {
            $params[] = "escape={$this->escape}";
        }
        $format = addcslashes($this->format, "'");
        $params[] = "'$format'";
        return implode(' ', $params);
    }
}
