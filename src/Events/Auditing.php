<?php

namespace DagaSmart\Auditing\Events;

use DagaSmart\Auditing\Contracts\Auditable;
use DagaSmart\Auditing\Contracts\AuditDriver;

class Auditing
{
    /**
     * Create a new Auditing event instance.
     */
    public function __construct(
        public Auditable $model,
        public AuditDriver $driver
    ) {
        //
    }
}
