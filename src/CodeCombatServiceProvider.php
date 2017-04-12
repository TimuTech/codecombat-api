<?php

namespace CodeCombat;

use CodeCombat\CodeCombat;
use CodeCombat\Contracts\ProviderContract;
use Illuminate\Support\ServiceProvider;

class CodeCombatServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProviderContract::class, function ($app) {
            return new CodeCombat(config('services.codecombat.id'), config('services.codecombat.secret'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ProviderContract::class];
    }
}
