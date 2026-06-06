<?php

namespace DagaSmart\Auditing\Events;

use DagaSmart\Auditing\Contracts\Auditable;

class DispatchingAudit
{
    /**
     * Create a new DispatchingAudit event instance.
     */
    public function __construct(
        public Auditable $model
    ) {
        //
    }
}
