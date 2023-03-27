<?php

declare(strict_types=1);

namespace Domain\FeatureFlag;

use Domain\Base\BaseBooleanValue;

class IsEnabled extends BaseBooleanValue
{
    public function displayName(): string
    {
        return $this->isYes() ? 'ON' : 'OFF';
    }
}
