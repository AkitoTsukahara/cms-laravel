<?php

declare(strict_types=1);

namespace Domain\Base;

interface Domainable
{
    public function toDomain();
}
