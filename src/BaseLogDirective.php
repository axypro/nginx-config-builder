<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\SingleDirective;

abstract class BaseLogDirective extends SingleDirective
{
    public bool $isOn = true;

    public function __construct(public ?string $path = null)
    {
        parent::__construct();
    }

    public function toDefault(): void
    {
        $this->path = null;
        $this->isOn = true;
    }

    public function off(): void
    {
        $this->isOn = false;
    }

    public function on(?string $path = null): void
    {
        $this->isOn = true;
        if ($path !== null) {
            $this->path = $path;
        }
    }

    public function getName(): ?string
    {
        if (($this->isOn) && ($this->path === null)) {
            return null;
        }
        return "{$this->name}_log";
    }

    protected string $name;
}
