# Block directives

There are four predefined classed for block directives `http`, `server`, `location` and `if`.

* `BlockDirective` (axy\nginx\config\syntax)
    * HSLIDirective
        * [HttpDirective](http.md)
        * SLIDirective
            * [ServerDirective](server.md)
            * LIDirective
                * [LocationDirective](location.md)
                * [IfDirective](if.md)

`HSLIDirective` contains common directives for contexts of all those block directives.
`SLIDirective` only for `server`, `location` and `if`.
`LIDirective` for `location` and `if` only.
