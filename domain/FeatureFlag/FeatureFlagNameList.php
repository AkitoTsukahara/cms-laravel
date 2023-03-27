<?php

declare(strict_types=1);

namespace Domain\FeatureFlag;

use Domain\Base\BaseListValue;

class FeatureFlagNameList extends BaseListValue
{
    public static function makeAllDefinedList(): self
    {
        $array = array_map(static function ($rawValue) {
            return new FeatureFlagName($rawValue);
        }, FeatureFlagName::getRawValueList());

        return new self($array);
    }
}
