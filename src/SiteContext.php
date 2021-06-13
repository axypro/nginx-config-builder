<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

class SiteContext extends FileContext
{
    public function server(string|array|null $name = null): ServerDirective
    {
        return $this->append(new ServerDirective($name));
    }
}
