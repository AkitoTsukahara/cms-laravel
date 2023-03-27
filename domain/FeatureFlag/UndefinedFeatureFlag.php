<?php

declare(strict_types=1);

namespace Domain\FeatureFlag;

use Domain\Base\Undefined;

class UndefinedFeatureFlag implements FeatureFlagInterface, Undefined
{
    public function equalsByName(FeatureFlagNameInterface $featureFlagName): bool
    {
        return false;
    }

    public function isEnabled(): bool
    {
        return false;
    }
}
