<?php

declare(strict_types=1);

namespace App\Service\Scenario\FeatureFlag;

use App\Service\Commnad\FeatureFlag\FeatureFlagCommandService;
use App\Service\Query\FeatureFlag\FeatureFlagQueryService;
use Domain\FeatureFlag\FeatureFlag;
use Domain\FeatureFlag\FeatureFlagList;
use Domain\FeatureFlag\FeatureFlagName;
use Domain\FeatureFlag\UpdateMessage;

class FeatureFlagScenarioService
{
    public function __construct(
        FeatureFlagQueryService $queryService,
        FeatureFlagCommandService $commandService
    ) {
        $this->queryService = $queryService;
        $this->commandService = $commandService;
    }

    public function get(FeatureFlagName $featureFlagName): FeatureFlag
    {
        return $this->queryService->get($featureFlagName);
    }

    public function getList(): FeatureFlagList
    {
        return $this->queryService->getList();
    }

    public function update(FeatureFlag $featureFlag, UpdateMessage $message): void
    {
        $this->commandService->update($featureFlag, $message);
    }
}
