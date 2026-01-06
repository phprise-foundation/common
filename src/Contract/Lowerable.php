<?php

declare(strict_types=1);

namespace Phprise\Common\Contract;

interface Lowerable
{
    public function toLower(): string;
}
