<?php

declare(strict_types=1);

namespace Phprise\Common\Contract;

interface Snakeable
{
    public function toSnake(): string;
}
