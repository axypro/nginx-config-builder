<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

class FPMDirectives extends FastCGIDirectives
{
    public function __construct(?string $entrypoint = null, ?string $pass = null)
    {
        parent::__construct();
        $this->setEntrypoint($entrypoint);
        $this->pass = $pass ?? 'localhost:9000';
    }

    public function setEntrypoint(?string $entrypoint): void
    {
        if ($entrypoint === null) {
            $this->directives['split_path_info'] = '^(.+\.php)(/.+)$';
            $this->directives['index'] = 'index.php';
            $this->params['SCRIPT_FILENAME'] = '$document_root$fastcgi_script_name';
        } else {
            $this->directives['split_path_info'] = null;
            $this->directives['index'] = null;
            $this->params['SCRIPT_FILENAME'] = '$document_root' . $entrypoint;
        }
    }
}
