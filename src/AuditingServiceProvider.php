<?php

namespace DagaSmart\Auditing;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use DagaSmart\Auditing\Console\AuditDriverCommand;
use DagaSmart\Auditing\Console\AuditResolverCommand;
use DagaSmart\Auditing\Console\InstallCommand;
use DagaSmart\Auditing\Contracts\Auditor;
use DagaSmart\Auditing\Events\AuditCustom;
use DagaSmart\Auditing\Events\DispatchAudit;
use DagaSmart\Auditing\Listeners\ProcessDispatchAudit;
use DagaSmart\Auditing\Listeners\RecordCustomAudit;

class AuditingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPublishing();
        $this->mergeConfigFrom(__DIR__.'/../config/audit.php', 'audit');

        if (!$this->app->make('config')->get('audit.enabled', true)) {
            return;
        }

        Event::listen(AuditCustom::class, RecordCustomAudit::class);
        Event::listen(DispatchAudit::class, ProcessDispatchAudit::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            AuditDriverCommand::class,
            AuditResolverCommand::class,
            InstallCommand::class,
        ]);

        $this->app->singleton(Auditor::class, function ($app) {
            return new \DagaSmart\Auditing\Auditor($app);
        });
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            // Lumen lacks a config_path() helper, so we use base_path()
            $this->publishes([
                __DIR__.'/../config/audit.php' => base_path('config/audit.php'),
            ], 'config');

            if (! class_exists('CreateAuditsTable')) {
                $this->publishes([
                    __DIR__.'/../database/migrations/audits.stub' => database_path(
                        sprintf('migrations/%s_create_audits_table.php', date('Y_m_d_His'))
                    ),
                ], 'migrations');
            }
        }
    }
}
