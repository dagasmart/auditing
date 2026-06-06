<?php

namespace DagaSmart\Auditing\Resolvers;

use Illuminate\Support\Facades\Request;
use DagaSmart\Auditing\Contracts\Auditable;
use DagaSmart\Auditing\Contracts\Resolver;

class IpAddressResolver implements Resolver
{
    public static function resolve(Auditable $auditable): string
    {
        return $auditable->preloadedResolverData['ip_address'] ?? Request::ip();
    }
}
