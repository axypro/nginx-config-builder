<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

class ErrorLogDirective extends BaseLogDirective
{
    public function __construct(public ?string $path = null, public ?string $level = null)
    {
        parent::__construct();
    }

    public function getParams(): string|array|null
    {
        if (!$this->isOn) {
            return '/dev/null';
        }
        $params = [$this->path];
        if ($this->level !== null) {
            $params[] = $this->level;
        }
        return $params;
    }

    protected string $name = 'error';
}
