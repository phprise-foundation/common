<?php

declare(strict_types=1);

namespace Phprise\Common\Contract;

interface Arrayable
{
    public function toArray(): array;
}