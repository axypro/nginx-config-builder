<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use axy\nginx\config\builder\FastCGIDirectives;

class FastcgiDirectivesTest extends BaseTestCase
{
    public function testToString(): void
    {
        $directives = new FastCGIDirectives();
        $directives->directives['split_path_info'] = '^(.+\.php)(/.+)$';
        $directives->directives['index'] = 'index.php';
        $directives->pass = 'http://localhost:9000';
        $directives->params['SCRIPT_FILENAME'] = '$document_root$fastcgi_script_name';
        $this->assertRenders([
            'fastcgi_split_path_info ^(.+\.php)(/.+)$;',
            'fastcgi_index index.php;',
            'fastcgi_pass http://localhost:9000;',
            'fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;',
            'include fastcgi_params;',
        ], $directives);
        $directives->directives['split_path_info'] = null;
        $directives->params['SCRIPT_FILENAME'] = null;
        $directives->include = null;
        $directives->comment->set('FastCGI');
        $this->assertRenders([
            '# FastCGI',
            'fastcgi_index index.php;',
            'fastcgi_pass http://localhost:9000;',
        ], $directives);
    }
}
