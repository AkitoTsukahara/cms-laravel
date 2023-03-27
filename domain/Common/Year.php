<?php

declare(strict_types=1);

namespace Domain\Common;

use CommonTime;
use Domain\Base\BaseNonNegativeIntValue;

class Year extends BaseNonNegativeIntValue
{
    public static function optionList(): array
    {
        $now = CommonTime::now();
        $yearInt = $now->getYear()->rawValue();

        $list = [];
        foreach (range($yearInt, $yearInt - 100) as $year) {
            $list[$year] = $year . '年';
        }

        return $list;
    }
}
