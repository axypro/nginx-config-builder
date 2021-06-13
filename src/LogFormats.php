<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\BaseContext;

class LogFormats extends BaseContext
{
    public function set(string $name, string $format, ?string $escape = null): LogFormatDirective
    {
        $item = $this->formats[$name] ?? null;
        if ($item !== null) {
            $item->format = $format;
            $item->escape = $escape;
        } else {
            $item = new LogFormatDirective($name, $format, $escape);
            $this->formats[$name] = $item;
        }
        return $item;
    }

    public function delete(string $name): void
    {
        unset($this->formats[$name]);
    }

    protected function getItems(): array
    {
        return $this->formats;
    }

    /** @var LogFormatDirective[] */
    private array $formats = [];
}
