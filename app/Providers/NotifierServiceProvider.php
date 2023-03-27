<?php

declare(strict_types=1);

namespace App\Providers;

use Domain\FeatureFlag\FeatureFlagNotifier;
use Illuminate\Support\ServiceProvider;
use Infra\Notification\Notifier\FeatureFlagNotifier as IlluminateFeatureFlagNotifier;

class NotifierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FeatureFlagNotifier::class, IlluminateFeatureFlagNotifier::class);
    }
}
