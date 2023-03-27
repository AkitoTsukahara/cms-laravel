<?php

declare(strict_types=1);

namespace Domain\FeatureFlag;

class FeatureFlagDomainService
{
    private FeatureFlagRepository $repository;
    //private FeatureFlagNotifier $featureFlagNotifier;

    public function __construct(
        FeatureFlagRepository $repository,
        //FeatureFlagNotifier $featureFlagNotifier,
    ) {
        $this->repository = $repository;
        //$this->featureFlagNotifier = $featureFlagNotifier;
    }

    public function get(FeatureFlagName $featureFlagName): FeatureFlag
    {
        try {
            return $this->repository->get($featureFlagName);
        } catch (\LogicException $e) {
            return FeatureFlag::makeDisabledByName($featureFlagName);
        }
    }

    public function getAllDefinedList(): FeatureFlagList
    {
        $savedList = $this->repository->getOnlyDefinedList();

        return FeatureFlagList::makeAllDefinedList($savedList);
    }

    public function getAllEnabledList(): FeatureFlagList
    {
        return $this->repository->getOnlyEnabledList();
    }

    public function update(FeatureFlag $featureFlag, UpdateMessage $message): void
    {
        $this->repository->upsert($featureFlag);
        //$this->featureFlagNotifier->notifyUpdated($featureFlag, $message);
    }
}
