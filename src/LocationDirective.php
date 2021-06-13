<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

class LocationDirective extends LIDirective
{
    public InternalDirective $internal;

    public function __construct(public ?string $uri = null, public ?string $modifier = null)
    {
        parent::__construct();
        $this->internal = $this->mainContext->append(new InternalDirective());
        $this->internal->disable();
    }

    public function getName(): string
    {
        return 'location';
    }

    public function exact(?string $uri = null): void
    {
        $this->setModifier('=', $uri);
    }

    public function prefix(?string $uri = null, bool $reg = false): void
    {
        $this->setModifier($reg ? '^~' : null, $uri);
    }

    public function reg(?string $uri = null, bool $ci = false): void
    {
        $this->setModifier($ci ? '~*' : '~', $uri);
    }

    public function named(string $name): void
    {
        $this->modifier = null;
        $this->uri = "@$name";
    }

    public function getParams(): string|array|null
    {
        $params = [];
        if ($this->modifier !== null) {
            $params[] = $this->modifier;
        }
        $params[] = $this->uri;
        return $params;
    }

    private function setModifier(?string $modifier, ?string $uri): void
    {
        $this->modifier = $modifier;
        if ($uri !== null) {
            $this->uri = $uri;
        }
    }
}
