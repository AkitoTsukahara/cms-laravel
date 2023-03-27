<?php

declare(strict_types=1);

namespace Domain\FeatureFlag;

use Domain\Base\BaseListValue;
use Domain\Base\Undefined;

class FeatureFlagList extends BaseListValue
{
    public static function makeAllDefinedList(self $savedList): self
    {
        $allDefinedArray = FeatureFlagNameList::makeAllDefinedList()->map(function (FeatureFlagName $name) use (
            $savedList
        ) {
            $extractedFlag = $savedList->findByFeatureFlagName($name);

            if ($extractedFlag instanceof Undefined) {
                return FeatureFlag::makeDisabledByName($name);
            }

            return $extractedFlag;
        });

        return new self($allDefinedArray);
    }

    public function isEnabledByName(FeatureFlagName $targetFeatureFlagName): bool
    {
        $targetFeatureFlag = $this->findByFeatureFlagName($targetFeatureFlagName);
        return $targetFeatureFlag->isEnabled();
    }

    private function findByFeatureFlagName(FeatureFlagName $targetFeatureFlagName): FeatureFlagInterface
    {
        $filteredArray = $this->filter(function (FeatureFlag $featureFlag) use ($targetFeatureFlagName) {
            return $featureFlag->equalsByName($targetFeatureFlagName);
        });

        if (count($filteredArray) === 0) {
            return new UndefinedFeatureFlag();
        }

        return $filteredArray[array_key_first($filteredArray)];
    }
}
