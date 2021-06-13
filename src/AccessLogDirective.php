<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

class AccessLogDirective extends BaseLogDirective
{
    public string|null $format = null;
    public string|int|null $buffer = null;
    public string|int|bool|null $gzip = null;
    public string|int|null $flush = null;
    public string|int|null $if = null;

    public function getParams(): string|array|null
    {
        if (!$this->isOn) {
            return 'off';
        }
        $params = [$this->path];
        if ($this->format !== null) {
            $params[] = $this->format;
        }
        $keys = ['buffer', 'gzip', 'flush', 'if'];
        foreach ($keys as $k) {
            $v = $this->$k;
            if (($v === null) || ($v === false)) {
                continue;
            }
            if (($v === true) || ($v === '')) {
                $params[] = $k;
            } else {
                $params[] = "$k=$v";
            }
        }
        return $params;
    }

    protected string $name = 'access';
}
