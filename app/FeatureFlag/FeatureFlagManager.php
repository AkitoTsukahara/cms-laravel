<?php

declare(strict_types=1);

namespace App\FeatureFlag;

use Domain\Common\CommonTime;
use Domain\FeatureFlag\FeatureFlagDomainService;
use Domain\FeatureFlag\FeatureFlagList;
use Domain\FeatureFlag\FeatureFlagName;

class FeatureFlagManager
{
    private FeatureFlagDomainService $domainService;
    private FeatureFlagList $featureFlagList;
    private ?CommonTime $lastFlagsUpdatedAt = null;

    public function __construct(
        FeatureFlagDomainService $domainService
    ) {
        $this->domainService = $domainService;
        // コンストラクタ内で FeatureFlagList を DB から取得する実装にした際、
        // CircleCI で Package Discovery のタイミングでテストが落ちる問題があったため、
        // 実際にフラグの ON/OFF を知るタイミングで DB からデータを取り出す。
        $this->featureFlagList = FeatureFlagList::makeEmpty();
    }

    private function shouldUpdateFeatureFlagList(): bool
    {
        if ($this->lastFlagsUpdatedAt === null || $this->featureFlagList->isEmpty()) {
            return true;
        }

        // NOTE: 30秒で更新されていない場合は更新する
        return CommonTime::now()->isLaterThan($this->lastFlagsUpdatedAt->addSeconds(30));
    }

    public function isEnabledByName(FeatureFlagName $targetFeatureFlagName): bool
    {
        if ($this->shouldUpdateFeatureFlagList()) {
            $this->featureFlagList = $this->domainService->getAllDefinedList();
            $this->lastFlagsUpdatedAt = CommonTime::now();
        }

        return $this->featureFlagList->isEnabledByName($targetFeatureFlagName);
    }

    /**
     * NOTE: デーモン化する際に常に最新の状態を取得したいので追加
     */
    public function refresh(): void
    {
        $this->featureFlagList = $this->domainService->getAllDefinedList();
    }

    // head.blade.phpでwindow.feature_flags変数に代入するのに使っています。
    public function getAllEnabledList(): FeatureFlagList
    {
        return $this->domainService->getAllEnabledList();
    }

    /**
     * @deprecated Unitテストから参照する用なので普段は使わないでください
     */
    public function isTestFlagEnabled(): bool
    {
        return $this->isEnabledByName(new FeatureFlagName(FeatureFlagName::TEST));
    }
}
