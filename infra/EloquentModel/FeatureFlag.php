<?php

declare(strict_types=1);

namespace Infra\EloquentModel;

use Domain\Base\Domainable;
use Domain\FeatureFlag\FeatureFlag as FeatureFlagDomain;
use Domain\FeatureFlag\FeatureFlagName;
use Domain\FeatureFlag\FeatureFlagNameData;
use Domain\FeatureFlag\IsEnabled;
use Infra\EloquentModel\Base\BaseModel;

class FeatureFlag extends BaseModel implements Domainable
{
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name', 'is_enabled'];

    public function toDomain(): FeatureFlagDomain
    {
        return new FeatureFlagDomain(
            new FeatureFlagName($this->name),
            new IsEnabled((bool) $this->is_enabled)
        );
    }

    public function toDataNameDomain(): FeatureFlagDomain
    {
        return new FeatureFlagDomain(
            new FeatureFlagNameData($this->name),
            new IsEnabled((bool) $this->is_enabled)
        );
    }
}
