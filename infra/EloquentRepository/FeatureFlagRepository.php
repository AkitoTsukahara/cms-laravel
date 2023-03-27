<?php

declare(strict_types=1);

namespace Infra\EloquentRepository;

use Domain\Exception\NotFoundException;
use Domain\FeatureFlag\FeatureFlag;
use Domain\FeatureFlag\FeatureFlagList;
use Domain\FeatureFlag\FeatureFlagName;
use Domain\FeatureFlag\FeatureFlagRepository as FeatureFlagRepositoryInterface;
use Infra\EloquentModel\FeatureFlag as FeatureFlagModel;

class FeatureFlagRepository implements FeatureFlagRepositoryInterface
{
    public function get(FeatureFlagName $featureFlagName): FeatureFlag
    {
        /** @var FeatureFlagModel $model */
        $model = FeatureFlagModel::where('name', $featureFlagName->rawValue())->first();

        if (is_null($model)) {
            throw new NotFoundException();
        }

        return $model->toDomain();
    }

    public function getOnlyDefinedList(): FeatureFlagList
    {
        $collection = FeatureFlagModel::whereIn('name', FeatureFlagName::getRawValueList())
            ->get();

        return new FeatureFlagList($collection->map(function (FeatureFlagModel $model) {
            return $model->toDomain();
        })->toArray());
    }

    public function getOnlyEnabledList(): FeatureFlagList
    {
        $collection = FeatureFlagModel::where('is_enabled', true)
            ->get();

        return new FeatureFlagList($collection->map(
            fn(FeatureFlagModel $model) => $model->toDataNameDomain()
        )->toArray());
    }

    public function upsert(FeatureFlag $featureFlag): void
    {
        FeatureFlagModel::updateOrCreate(
            ['name' => $featureFlag->toArrayForStore()['name']],
            ['is_enabled' => $featureFlag->toArrayForStore()['is_enabled']],
        );
    }
}
