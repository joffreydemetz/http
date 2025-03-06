# JDZ HTTP Utils

Some useful utilities for HTTP responses (codes).

## Installation

To install this library, use Composer:

```sh
composer require jdz/http
```

## Usage

### HttpStatusCode
The HttpStatusCode enum provides numeric values for HTTP status codes.

```php
<?php
$statusCode = \JDZ\Utils\HttpStatusCode::HTTP_200;
echo $statusCode->value; // 200
```

### HttpStatusText
The HttpStatusText enum provides text values for HTTP status codes.

```php
<?php
$statusText = \JDZ\Utils\HttpStatusText::HTTP_200;
echo $statusText->value; // OK
```

### HttpStatusAlias
The HttpStatusAlias enum provides alias values for HTTP status codes.

```php
<?php
$statusAlias = \JDZ\Utils\HttpStatusAlias::HTTP_200;
echo $statusAlias->value; // HTTP_OK
```

### Converting Between Enums
You can convert between the different enums using the provided static methods.

```php
<?php
use JDZ\Utils\HttpStatusCode;
use JDZ\Utils\HttpStatusText;
use JDZ\Utils\HttpStatusAlias;

$statusCode = HttpStatusCode::HTTP_200;
$statusText = HttpStatusText::fromHttpStatusCode($statusCode);
$statusAlias = HttpStatusAlias::fromHttpStatusCode($statusCode);

echo $statusText->value; // OK
echo $statusAlias->value; // HTTP_OK
```

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Author

- Joffrey Demetz - [joffreydemetz.com](https://joffreydemetz.com)

For more examples, see the examples directory.
