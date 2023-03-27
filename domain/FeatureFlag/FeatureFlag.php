<?php

declare(strict_types=1);

namespace Domain\FeatureFlag;

use Domain\Base\Storable;

class FeatureFlag implements FeatureFlagInterface, Storable
{
    private FeatureFlagNameInterface $featureFlagName;
    private IsEnabled $isEnabled;

    public function __construct(
        FeatureFlagNameInterface $featureFlagName,
        IsEnabled $isEnabled
    ) {
        $this->featureFlagName = $featureFlagName;
        $this->isEnabled = $isEnabled;
    }

    public static function makeDisabledByName(FeatureFlagNameInterface $featureFlagName): self
    {
        return new self($featureFlagName, IsEnabled::createNo());
    }

    public function keyName(): string
    {
        return $this->featureFlagName->rawValue();
    }

    public function displayName(): string
    {
        return $this->featureFlagName->displayName();
    }

    public function displayIsEnabled(): string
    {
        return $this->isEnabled->displayName();
    }

    public function equalsByName(FeatureFlagNameInterface $featureFlagName): bool
    {
        return $this->featureFlagName->equals($featureFlagName);
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled->rawValue();
    }

    public function isDisabled(): bool
    {
        return !$this->isEnabled();
    }

    public function toArrayForStore(): array
    {
        return [
            'name' => $this->featureFlagName->rawValue(),
            'is_enabled' => $this->isEnabled->rawValue(),
        ];
    }
}
