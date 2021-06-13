<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\CustomSingleDirective;

class HttpDirective extends HSLIDirective
{
    public LogFormats $logFormats;

    public function __construct()
    {
        parent::__construct();
        $this->logFormats = $this->mainContext->append(new LogFormats());
    }

    public function getName(): string
    {
        return 'http';
    }

    public function server(string|array|null $name = null): ServerDirective
    {
        return $this->mainContext->append(new ServerDirective($name));
    }

    public function include(string $file): CustomSingleDirective
    {
        return $this->mainContext->append(new CustomSingleDirective('include', $file));
    }
}
