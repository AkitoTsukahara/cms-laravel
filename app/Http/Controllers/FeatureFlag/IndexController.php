<?php

declare(strict_types=1);

namespace App\Http\Controllers\FeatureFlag;

use App\Service\Scenario\FeatureFlag\FeatureFlagScenarioService;

class IndexController
{
    public function __construct(FeatureFlagScenarioService $scenarioService
    ) {
        $this->scenarioService = $scenarioService;
    }

    public function __invoke()
    {
        $featureFlagList = $this->scenarioService->getList();
        return \view('feature-flag.index', ['featureFlagList' => $featureFlagList]);
    }
}
