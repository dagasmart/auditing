<?php

namespace DagaSmart\Auditing\Resolvers;

use DagaSmart\Auditing\Contracts\Auditable;
use DagaSmart\Auditing\Contracts\Resolver;

class DumpResolver implements Resolver
{
    public static function resolve(Auditable $auditable): string
    {
        return '';
    }
}
