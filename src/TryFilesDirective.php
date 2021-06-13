<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\DirectiveMultiParams;

class TryFilesDirective extends DirectiveMultiParams
{
    protected string $name = 'try_files';

    public function __construct(array|string|int|null $value, public ?int $code = null)
    {
        parent::__construct($value);
    }

    public function getParams(): string|array|null
    {
        $params = parent::getParams();
        if ($this->code !== null) {
            $params[] = "={$this->code}";
        }
        return $params;
    }
}
