<?php

declare(strict_types=1);

namespace axy\nginx\config\builder\tests;

use axy\nginx\config\builder\IfDirective;
use axy\nginx\config\builder\ServerDirective;

class FPMLocationDirectiveTest extends BaseTestCase
{
    public function testToString(): void
    {
        $server = new ServerDirective('example.com');
        $fpm = $server->fpm(null);
        $this->assertRenders([
            'server {',
            "\tserver_name example.com;",
            "\tlisten 80;",
            "\tlocation ~ \.php$ {",
            "\t\ttry_files \$uri /index.php =404;",
            "\t\tfastcgi_split_path_info ^(.+\.php)(/.+)$;",
            "\t\tfastcgi_index index.php;",
            "\t\tfastcgi_pass localhost:9000;",
            "\t\tfastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;",
            "\t\tinclude fastcgi_params;",
            "\t}",
            '}',
        ], $server);
        $fpm->setEntrypoint('/index.php');
        $fpm->setPass('php-fpm');
        $fpm->topContext->append('dir;');
        $this->assertRenders([
            'server {',
            "\tserver_name example.com;",
            "\tlisten 80;",
            "\tlocation / {",
            "\t\tdir;",
            "\t\tfastcgi_pass php-fpm;",
            "\t\tfastcgi_param SCRIPT_FILENAME \$document_root/index.php;",
            "\t\tinclude fastcgi_params;",
            "\t}",
            '}',
        ], $server);
    }
}
