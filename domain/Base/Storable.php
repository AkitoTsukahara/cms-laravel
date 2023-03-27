<?php

declare(strict_types=1);

namespace Domain\Base;

interface Storable
{
    public function toArrayForStore();
}
