<?php

declare(strict_types=1);

namespace Phprise\Common\Contract;

interface Camelable
{
    public function toCamel(): string;
}
