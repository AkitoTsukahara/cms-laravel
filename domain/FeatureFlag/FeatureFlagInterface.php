<?php

declare(strict_types=1);

namespace Domain\FeatureFlag;

interface FeatureFlagInterface
{
    public function equalsByName(FeatureFlagNameInterface $featureFlagName): bool;

    public function isEnabled(): bool;
}
