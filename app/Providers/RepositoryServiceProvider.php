<?php

declare(strict_types=1);

namespace App\Providers;

use Domain\FeatureFlag\FeatureFlagRepository;
use Illuminate\Support\ServiceProvider;
use Infra\EloquentRepository\FeatureFlagRepository as EloquentFeatureFlagRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind(FeatureFlagRepository::class, EloquentFeatureFlagRepository::class);
    }
}
