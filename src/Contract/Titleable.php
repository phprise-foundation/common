<?php

declare(strict_types=1);

namespace Phprise\Common\Contract;

interface Titleable
{
    public function toTitle(): string;
}
