<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\BaseContext;

class LogDirectives extends BaseContext
{
    public AccessLogDirective $access;
    public ErrorLogDirective $error;

    public function __construct()
    {
        parent::__construct();
        $this->access = new AccessLogDirective();
        $this->error = new ErrorLogDirective();
    }

    public function toDefault(): void
    {
        $this->access->toDefault();
        $this->error->toDefault();
    }

    public function off(): void
    {
        $this->access->off();
        $this->error->off();
    }

    public function on(?string $prefix = null): void
    {
        $this->access->on($prefix ? "{$prefix}access.log" : null);
        $this->error->on($prefix ? "{$prefix}error.log" : null);
    }

    protected function getItems(): array
    {
        return [
            $this->access,
            $this->error,
        ];
    }
}
