<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\BlockDirective;
use axy\nginx\config\syntax\CustomSingleDirective;

/**
 * Base class for http, server, location and if directives
 */
abstract class HSLIDirective extends BlockDirective
{
    public IndexDirective $index;
    public RootDirective $root;
    public AuthBasicDirectives $authBasic;

    public function __construct()
    {
        parent::__construct();
        $this->index = $this->mainContext->append(new IndexDirective([]));
        $this->root = $this->mainContext->append(new RootDirective());
        $this->authBasic = $this->mainContext->append(new AuthBasicDirectives());
    }

    public function denyAll(): CustomSingleDirective
    {
        return $this->mainContext->append(new CustomSingleDirective('deny', 'all'));
    }
}
