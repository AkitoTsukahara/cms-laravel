<?php

declare(strict_types=1);

namespace App\Providers;

use App\FeatureFlag\FeatureFlagManager;
use Illuminate\Support\ServiceProvider;

class FeatureFlagManagerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('FeatureFlagManager', FeatureFlagManager::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
