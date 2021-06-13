<?php

declare(strict_types=1);

namespace axy\nginx\config\builder;

class MainContext extends FileContext
{
    public UserDirective $user;
    public LogDirectives $log;
    public HttpDirective $http;

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->append(new UserDirective());
        $this->log = $this->append(new LogDirectives());
        $this->http = $this->append(new HttpDirective());
    }
}
