<?php

declare(strict_types=1);

namespace Domain\FeatureFlag;

interface FeatureFlagNotifier
{
    public function notifyUpdated(FeatureFlag $featureFlag, UpdateMessage $message): void;
}
