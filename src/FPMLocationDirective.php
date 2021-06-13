<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

class FPMLocationDirective extends LocationDirective
{
    public FPMDirectives $fpm;
    public TryFilesDirective $tryFiles;

    public function __construct(?string $entrypoint = null)
    {
        parent::__construct();
        $this->tryFiles = $this->mainContext->append(new TryFilesDirective([]));
        $this->setEntrypoint($entrypoint);
    }

    public function setEntrypoint(?string $entrypoint): void
    {
        if (!$this->created) {
            $this->fpm = $this->mainContext->append(new FPMDirectives($entrypoint));
            $this->created = true;
        } else {
            $this->fpm->setEntrypoint($entrypoint);
        }
        if ($entrypoint === null) {
            $this->uri = '\.php$';
            $this->modifier = '~';
            $this->tryFiles->enable();
            $this->tryFiles->set(['$uri', '/index.php']);
            $this->tryFiles->code = 404;
        } else {
            $this->uri = '/';
            $this->modifier = null;
            $this->tryFiles->disable();
        }
    }

    public function setPass(?string $pass): void
    {
        $this->fpm->pass = $pass;
    }

    private bool $created = false;
}
