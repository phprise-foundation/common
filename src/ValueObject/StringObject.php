<?php

declare(strict_types=1);

namespace Phprise\Common\ValueObject;

use Phprise\Common\Contract\Camelable;
use Phprise\Common\Contract\Kebabable;
use Phprise\Common\Contract\Lowerable;
use Phprise\Common\Contract\Pascalable;
use Phprise\Common\Contract\Snakeable;
use Phprise\Common\Contract\Titleable;
use Phprise\Common\Contract\Upperable;
use Stringable;

class StringObject implements
    Stringable,
    Camelable,
    Kebabable,
    Lowerable,
    Pascalable,
    Snakeable,
    Titleable,
    Upperable
{
    private string $value;
    /** @var string[] */
    private array $words;

    public function __construct(string $value)
    {
        $this->value = $value;
        $this->words = $this->parseWords($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(Stringable|string $other): bool
    {
        return $this->value === (string) $other;
    }

    public function toCamel(): string
    {
        $words = array_map(fn($word) => ucfirst(strtolower($word)), $this->words);

        return lcfirst(implode('', $words));
    }

    public function toSnake(): string
    {
        return implode('_', array_map('strtolower', $this->words));
    }

    public function toPascal(): string
    {
        return implode('', array_map(fn($word) => ucfirst(strtolower($word)), $this->words));
    }

    public function toKebab(): string
    {
        return implode('-', array_map('strtolower', $this->words));
    }

    public function toUpper(): string
    {
        return strtoupper($this->value);
    }

    public function toLower(): string
    {
        return strtolower($this->value);
    }

    public function toTitle(): string
    {
        return implode(' ', array_map(fn($word) => ucfirst(strtolower($word)), $this->words));
    }

    /**
     * @return string[]
     */
    private function parseWords(string $input): array
    {
        $input = trim($input);
        if ($input === '') {
            return [];
        }

        $parts = preg_split(
            '/(?<=[a-z])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][a-z])|[\s_-]+/',
            $input,
            -1,
            PREG_SPLIT_NO_EMPTY
        );

        return $parts ?: [];
    }
}