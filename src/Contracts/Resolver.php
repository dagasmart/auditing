<?php

namespace DagaSmart\Auditing\Contracts;

interface Resolver
{
    /** @return mixed */
    public static function resolve(Auditable $auditable);
}
