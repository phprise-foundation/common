# Common

Common objects for general usage in PHP projects, specifically Value Objects and Contracts.

## Installation

```bash
composer require phprise/common
```

## Usage

### Value Objects

#### StringObject

A wrapper for string manipulation implementing `Stringable` and specific contract interfaces (`Camelable`, `Snakeable`, `Pascalable`, `Kebabable`, `Titleable`, `Upperable`, `Lowerable`).

```php
use Phprise\Common\ValueObject\StringObject;

$str = new StringObject('hello_world');

echo $str->toCamel();   // helloWorld
echo $str->toPascal();  // HelloWorld
echo $str->toKebab();   // hello-world
echo $str->toTitle();   // Hello World
echo $str->toUpper();   // HELLO_WORLD
```

#### ArrayObject

An extension of the native `ArrayObject` with extra utilities.

```php
use Phprise\Common\ValueObject\ArrayObject;

$arr = new ArrayObject(['old_key' => 'value']);

// Replace a key while keeping the value
$arr->replaceKey('old_key', 'new_key');

echo $arr['new_key']; // value
```

---

## Philosophy

Please read [PHILOSOPHY.md](PHILOSOPHY.md) to learn more about our philosophy.

---

## License

MIT License

---

## Contributing

Check [CONTRIBUTING.md](CONTRIBUTING.md) to learn more about our contributing guidelines.

---

## Code of Conduct

Check [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) to learn more about our code of conduct.

---

## Security

Check [SECURITY.md](SECURITY.md) to learn more about our security policy.

---

## Changelog

Check [CHANGELOG.md](CHANGELOG.md) for more information.
