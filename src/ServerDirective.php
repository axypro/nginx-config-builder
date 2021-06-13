<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

class ServerDirective extends SLIDirective
{
    public ServerNameDirective $serverName;
    public ListenDirective $listen;
    public LogDirectives $log;

    public function __construct(string|array|null $name = null)
    {
        parent::__construct();
        $this->serverName = $this->mainContext->append(new ServerNameDirective($name));
        $this->listen = $this->mainContext->append(new ListenDirective());
        $this->log = $this->mainContext->append(new LogDirectives());
    }

    public function redirectServerTo(string $target): self
    {
        $location = $this->location('/');
        $location->return(code: 301, url: $target . '$request_uri');
        return $this;
    }

    public function fpm(?string $entrypoint = null): FPMLocationDirective
    {
        return $this->append(new FPMLocationDirective($entrypoint));
    }

    public function getName(): ?string
    {
        return 'server';
    }
}
