<?php

namespace Domain\FeatureFlag;

use Domain\Base\BaseStringValue;

interface FeatureFlagNameInterface
{
    public function rawValue();

    public function __toString();
}
