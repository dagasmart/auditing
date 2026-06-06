<?php

namespace DagaSmart\Auditing\Resolvers;

use Illuminate\Support\Facades\Request;
use DagaSmart\Auditing\Contracts\Auditable;
use DagaSmart\Auditing\Contracts\Resolver;

class UserAgentResolver implements Resolver
{
    public static function resolve(Auditable $auditable): string
    {
        return $auditable->preloadedResolverData['user_agent'] ?? Request::header('User-Agent', '');
    }
}
