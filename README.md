# Common

Common objects for general usage in PHP projects, including Data Transfer Objects (DTOs), Value Objects, and HTTP Request wrappers.

## Installation

```bash
composer require phprise/common
```

## Usage

### TransferObject (DTO)

The `TransferObject` class helps you map arrays to objects with type safety, recursion, and convenient serialization methods.

#### Basic Usage

```php
use Phprise\Common\DTO\TransferObject;

class User extends TransferObject
{
    // Public properties are automatically mapped
    public string $name;
    public int $age;

    // You can also use DateTimeImmutable, it will be automatically converted from ISO string
    public \DateTimeImmutable $createdAt;
}

$user = User::fromArray([
    'name' => 'John Doe',
    'age' => 30,
    'created_at' => '2023-10-27T10:00:00+00:00', // Snake case keys are automatically converted to camelCase properties
]);

echo $user->name; // John Doe
echo $user->createdAt->format('Y-m-d'); // 2023-10-27
```

#### Serialization

```php
// Convert back to array
$array = $user->toArray();

// Convert to JSON
$json = $user->toJson();

// Convert to Snake Case array (useful for database or API responses)
$snakeArray = $user->toSnakeCaseArray(); // ['name' => 'John Doe', 'created_at' => ...]
```

#### Nested Objects

`TransferObject` supports nested DTOs.

```php
class Address extends TransferObject
{
    public string $city;
    public string $country;
}

class UserProfile extends TransferObject
{
    public string $username;
    public Address $address; // Type hint the nested DTO
}

$profile = UserProfile::fromArray([
    'username' => 'jdoe',
    'address' => [
        'city' => 'New York',
        'country' => 'USA'
    ]
]);

echo $profile->address->city; // New York
```

### TransferObjectCollection

A collection wrapper for `TransferObject`s, implementing `Doctrine\Common\Collections\Collection`.

```php
use Phprise\Common\DTO\TransferObjectCollection;

class UserCollection extends TransferObjectCollection
{
    // Optional: Override createFrom if you need custom instantiation logic
}

$collection = UserCollection::fromArray([
    new User(['name' => 'Alice']),
    new User(['name' => 'Bob']),
]);

// Or if you want to initialize from raw arrays, you might handle that in your collection or manually map
// Standard behavior expects elements to be passed to constructor

// Filtering
$filtered = $collection->filter(fn($user) => $user->name === 'Alice');
echo $filtered->count(); // 1
```

### Value Objects

#### StringObject

A wrapper for string manipulation.

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

### Requests

Abstract classes to wrap Guzzle PSR-7 Requests for common HTTP methods. Useful for building API clients.

```php
use Phprise\Common\Request\StoreRequest;
use Phprise\Common\Request\UpdateRequest;

class CreateUserRequest extends StoreRequest
{
    public function __construct(array $userData)
    {
        parent::__construct(
            '/api/users',
            json_encode($userData),
            ['Content-Type' => 'application/json']
        );
    }
}

class UpdateUserRequest extends UpdateRequest
{
    public function __construct(int $id, array $userData)
    {
        parent::__construct(
            "/api/users/{$id}",
            json_encode($userData),
            ['Content-Type' => 'application/json']
        );
    }
}

// Usage
$request = new CreateUserRequest(['name' => 'John']);
// $request is now a PSR-7 Request object ready to be sent with a matching client
```

Available Request classes:
- `StoreRequest` (POST)
- `UpdateRequest` (PATCH)
- `ReplaceRequest` (PUT)
- `DestroyRequest` (DELETE)
- `ShowRequest` (GET)

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
