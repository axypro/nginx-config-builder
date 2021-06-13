<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\BaseContext;

class FastCGIDirectives extends BaseContext
{
    /** @var string[] name without "fastcgi" => value */
    public array $directives = [];

    /** @var string|null value for "fastcgi_pass"  */
    public ?string $pass = null;

    /** @var string[] values for fastcgi_param */
    public array $params = [];

    /** @var string|null include after directives */
    public ?string $include = 'fastcgi_params';

    protected function getItems(): array
    {
        $items = [];
        foreach ($this->directives as $k => $v) {
            if ($v !== null) {
                $items[] = "fastcgi_$k $v;";
            }
        }
        if ($this->pass !== null) {
            $items[] = "fastcgi_pass {$this->pass};";
        }
        foreach ($this->params as $k => $v) {
            if ($v !== null) {
                $items[] = "fastcgi_param $k $v;";
            }
        }
        if ($this->include !== null) {
            $items[] = "include {$this->include};";
        }
        return $items;
    }
}
