<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use axy\nginx\config\builder\FPMDirectives;

class FPMDirectivesTest extends BaseTestCase
{
    public function testToString(): void
    {
        $fpm = new FPMDirectives();
        $this->assertRenders([
            'fastcgi_split_path_info ^(.+\.php)(/.+)$;',
            'fastcgi_index index.php;',
            'fastcgi_pass localhost:9000;',
            'fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;',
            'include fastcgi_params;',
        ], $fpm);
        $fpm->setEntrypoint('/index.php');
        $fpm->pass = 'php-fpm';
        $fpm->params['X'] = 'y';
        $this->assertRenders([
            'fastcgi_pass php-fpm;',
            'fastcgi_param SCRIPT_FILENAME $document_root/index.php;',
            'fastcgi_param X y;',
            'include fastcgi_params;',
        ], $fpm);
    }
}
