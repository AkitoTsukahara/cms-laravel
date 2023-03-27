<?php

declare(strict_types=1);

namespace App\Http\Controllers\FeatureFlag\Update;


use App\Service\Scenario\FeatureFlag\FeatureFlagScenarioService;
use Domain\FeatureFlag\FeatureFlagName;

class IndexController
{
    public function __construct(FeatureFlagScenarioService $scenarioService
    ) {
        $this->scenarioService = $scenarioService;
    }

    public function __invoke($name)
    {
        $featureFlag = $this->scenarioService->get(new FeatureFlagName($name));
        return \view('feature-flag.update.index', ['featureFlag' => $featureFlag]);
    }
}
