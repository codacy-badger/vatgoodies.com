<?php

namespace App\Providers;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\ServiceProvider;
use PragmaRX\Version\Package\Version;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Bugsnag::setAppVersion(app(Version::class)->format('version'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == ('production' || 'staging')) {
            $this->app->alias('bugsnag.multi', \Illuminate\Contracts\Logging\Log::class);
            $this->app->alias('bugsnag.multi', \Psr\Log\LoggerInterface::class);
        }
    }
}
