<?php

declare(strict_types=1);

namespace Domain\FeatureFlag;

interface FeatureFlagRepository
{
    public function get(FeatureFlagName $featureFlagName): FeatureFlag;

    public function getOnlyDefinedList(): FeatureFlagList;

    public function getOnlyEnabledList(): FeatureFlagList;

    public function upsert(FeatureFlag $featureFlag): void;
}
