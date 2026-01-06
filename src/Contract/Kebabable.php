<?php

declare(strict_types=1);

namespace Phprise\Common\Contract;

interface Kebabable
{
    public function toKebab(): string;
}
