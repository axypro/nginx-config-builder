<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\SingleDirective;

class ListenDirective extends SingleDirective
{
    public ?string $port = null;
    public ?string $address = null;
    public ?string $socket = null;
    public bool $isDefault = false;
    public bool $isSSL = false;
    public array $additional = [];

    public function getName(): ?string
    {
        return 'listen';
    }

    public function getParams(): string|array|null
    {
        $params = [$this->getAddress()];
        if ($this->isDefault) {
            $params[] = 'default_server';
        }
        if ($this->isSSL) {
            $params[] = 'ssl';
        }
        foreach ($this->additional as $k => $v) {
            if (($v === null) || ($v === false)) {
                continue;
            }
            if (($v === true) || ($v === '')) {
                $params[] = "$k";
            } else {
                $params[] = "$k=$v";
            }
        }
        return $params;
    }

    private function getAddress(): string
    {
        if ($this->socket !== null) {
            return "unix:{$this->socket}";
        }
        $port = $this->port ?? ($this->isSSL ? '443' : '80');
        if ($this->address === null) {
            return $port;
        }
        return "{$this->address}:$port";
    }
}
