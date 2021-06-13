<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\SingleDirective;

class UserDirective extends SingleDirective
{
    public function __construct(public ?string $user = null, public ?string $group = null)
    {
        parent::__construct();
    }

    public function set(?string $user, ?string $group): void
    {
        $this->user = $user;
        $this->group = $group;
    }

    public function getName(): ?string
    {
        if ($this->user === null) {
            return null;
        }
        return 'user';
    }

    public function getParams(): string|array|null
    {
        $params = [$this->user];
        if ($this->group !== null) {
            $params[] = $this->group;
        }
        return $params;
    }
}
