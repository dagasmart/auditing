<?php

namespace DagaSmart\Auditing\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \DagaSmart\Auditing\Contracts\AuditDriver auditDriver(\DagaSmart\Auditing\Contracts\Auditable $model);
 * @method static void execute(\DagaSmart\Auditing\Contracts\Auditable $model);
 */
class Auditor extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return \DagaSmart\Auditing\Contracts\Auditor::class;
    }
}
