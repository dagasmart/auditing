<?php

namespace DagaSmart\Auditing\Listeners;

use DagaSmart\Auditing\Events\AuditCustom;
use DagaSmart\Auditing\Facades\Auditor;

class RecordCustomAudit
{
    public function handle(AuditCustom $event): void
    {
        Auditor::execute($event->model);
    }
}
