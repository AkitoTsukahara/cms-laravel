<?php

declare(strict_types=1);

namespace Domain\FeatureFlag;

use Domain\Base\BaseEnum;
use Domain\Exception\InvalidArgumentException;

class FeatureFlagName extends BaseEnum implements FeatureFlagNameInterface
{
    /**
     * 新たに feature flag を追加する際はこのクラスのプロパティとして追加する。
     **/
    public const TEST = '2023_03_27_test';

    public function __construct($value)
    {
        parent::__construct($value);
        if (!$this->isValidValue()) {
            throw new InvalidArgumentException('引数の形式は YYYY_MM_DD_name でなければなりません');
        }
    }

    /**
     * 過去に使用したフラグと新規追加するフラグの間で名前が重複した場合、 DB に残存するレコードによって
     * 意図せずにフラグが ON になる懸念があるため、フラグ名は YYYY_MM_DD_name のような形式に限定する。
     *
     * @return bool
     */
    private function isValidValue(): bool
    {
        return (bool)preg_match('/\d{4}_\d{2}_\d{2}_.+$/', $this->rawValue());
    }

    public function displayName(): string
    {
        return $this->rawValue();
    }
}
