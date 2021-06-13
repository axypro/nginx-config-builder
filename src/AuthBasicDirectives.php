<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\BaseContext;
use axy\nginx\config\syntax\CustomSingleDirective;

class AuthBasicDirectives extends BaseContext
{
    public function __construct()
    {
        parent::__construct();
        $this->disable();
    }

    public function on(string $fn, string $prompt): void
    {
        $this->enable();
        $this->fn = $fn;
        $this->prompt = $prompt;
    }

    public function off(): void
    {
        $this->enable();
        $this->fn = null;
        $this->prompt = null;
    }

    protected function getItems(): array
    {
        if ($this->fn !== null) {
            return [
                new CustomSingleDirective('auth_basic', '"' . addcslashes($this->prompt, '"') . '"'),
                new CustomSingleDirective('auth_basic_user_file', [$this->fn]),
            ];
        }
        return [
            new CustomSingleDirective('auth_basic', ['off']),
        ];
    }

    protected string $name = 'error';

    private ?string $fn = null;

    private ?string $prompt = null;
}
