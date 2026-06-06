<?php

namespace DagaSmart\Auditing\Events;

use DagaSmart\Auditing\Contracts\Auditable;

class AuditCustom
{
    /**
     * Create a new Auditing event instance.
     */
    public function __construct(
        public Auditable $model
    ) {
        //
    }
}
