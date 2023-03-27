<?php

declare(strict_types=1);

namespace App\Service\Query\FeatureFlag;

use Domain\FeatureFlag\FeatureFlag;
use Domain\FeatureFlag\FeatureFlagDomainService;
use Domain\FeatureFlag\FeatureFlagList;
use Domain\FeatureFlag\FeatureFlagName;

class FeatureFlagQueryService
{
    private FeatureFlagDomainService $domainService;

    public function __construct(
        FeatureFlagDomainService $domainService
    ) {
        $this->domainService = $domainService;
    }

    public function get(FeatureFlagName $featureFlagName): FeatureFlag
    {
        return $this->domainService->get($featureFlagName);
    }

    public function getList(): FeatureFlagList
    {
        return $this->domainService->getAllDefinedList();
    }
}
