<?php

namespace DagaSmart\Auditing\Events;

use DagaSmart\Auditing\Contracts\Audit;
use DagaSmart\Auditing\Contracts\Auditable;
use DagaSmart\Auditing\Contracts\AuditDriver;

class Audited
{
    /**
     * Create a new Audited event instance.
     */
    public function __construct(
        public Auditable $model,
        public AuditDriver $driver,
        public ?Audit $audit = null
    ) {
        //
    }
}
