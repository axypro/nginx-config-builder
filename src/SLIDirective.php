<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

use axy\nginx\config\syntax\CustomSingleDirective;
use axy\nginx\config\syntax\SingleDirective;

/**
 * Base class for server, location and if directives
 */
abstract class SLIDirective extends HSLIDirective
{
    public function location(?string $uri = null, ?string $modifier = null): LocationDirective
    {
        return $this->append(new LocationDirective(uri: $uri, modifier: $modifier));
    }

    public function if(string $condition = ''): IfDirective
    {
        return $this->append(new IfDirective($condition));
    }

    public function return(?int $code = null, ?string $url = null, ?string $text = null): SingleDirective
    {
        $params = [];
        if ($code !== null) {
            $params[] = $code;
            if ($url !== null) {
                $params[] = $url;
            } elseif ($text !== null) {
                $params[] = $text;
            }
        } elseif ($url !== null) {
            $params[] = $url;
        }
        $directive = $this->append(new CustomSingleDirective('return', $params));
        if (empty($params)) {
            $directive->disable();
        }
        return $directive;
    }
}
