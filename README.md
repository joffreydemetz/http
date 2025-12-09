# JDZ HTTP Status

Some useful utilities for HTTP responses (codes).

## Installation

To install this library, use Composer:

```sh
composer require jdz/http
```

## Versions 

**V1**: Provides three separate enums: `HttpStatusCode`, `HttpStatusText`, and `HttpStatusAlias`.

**V2**: Added a single combined enum: `HttpStatus` with methods to get code, text, and alias.

**Both approaches are valid and produce the same results!**
The three separate enums (`HttpStatusCode`, `HttpStatusText`, `HttpStatusAlias`) do exactly the same thing as `HttpStatus`, but `HttpStatus` combines them into a single, more convenient API with built-in `getText()` and `getAlias()` methods.

### Use HttpStatus when:
- You want a simple, all-in-one solution
- You need code, text, and alias together
- You prefer a cleaner API

```php
$status = HttpStatus::HTTP_200;
echo $status->value;       // 200
echo $status->getText();   // OK
echo $status->getAlias();  // HTTP_OK
```

### Use Separate Enums when:
- You only need specific information (e.g., just codes)
- You want more granular control
- You're building a more complex system with specific requirements

```php
$code = HttpStatusCode::HTTP_200;
$text = HttpStatusText::fromHttpStatusCode($code);
$alias = HttpStatusAlias::fromHttpStatusCode($code);

echo $code->value;   // 200
echo $text->value;   // OK
echo $alias->value;  // HTTP_OK
```

## Usage

### HttpStatus
The HttpStatus enum provides numeric values for HTTP status codes [https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml](as registered by IANA).

```php
<?php
$status = \JDZ\Utils\HttpStatus::HTTP_200;
echo $status->value;       // 200
echo $status->getText();   // OK
echo $status->getAlias();  // HTTP_OK
```

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

## Examples

This directory contains examples demonstrating how to use the JDZ HTTP Utils library.
You can run any example using PHP from the command line:

```bash
php examples/1-basic-usage.php
php examples/2-separate-enums.php
php examples/3-comparison.php
php examples/4-api-response.php
php examples/5-dynamic-lookup.php
php examples/6-all-categories.php
php examples/7-from-alias.php
```

### 1. HttpStatus enum (v 2.0) (`1-basic-usage.php`)
Shows how to use the **HttpStatus** enum (combined approach) to get status codes, text descriptions, and aliases all from one enum.

**Key Points:**
- Single enum provides all information
- Simple API with `getText()` and `getAlias()` methods
- Clean and concise code

### 2. Separate Enums (v 1.0) (`2-separate-enums.php`)
Demonstrates using **HttpStatusCode**, **HttpStatusText**, and **HttpStatusAlias** separately to achieve the same results.

**Key Points:**
- Three separate enums for different purposes
- More granular control
- Can convert between enums using `from*()` methods

### 3. Comparison (`3-comparison.php`)
Side-by-side comparison showing that both approaches (HttpStatus vs. separate enums) produce identical results.

### 4. API Response (`4-api-response.php`)
Real-world example showing how to use both approaches in API response classes.

**Key Points:**
- Practical API implementation
- Error handling examples
- JSON response formatting

### 5. Dynamic Lookup (`5-dynamic-lookup.php`)
Shows how to dynamically look up status codes using the `fromName()` method in both approaches.

**Key Points:**
- Runtime status code resolution
- Error handling with `ValueError`
- Useful for configuration-driven applications

### 6. All Categories (`6-all-categories.php`)
Comprehensive example working with all HTTP status categories (1xx through 5xx).

### 7. Using fromAlias() (`7-from-alias.php`)
Demonstrates the `fromAlias()` method for retrieving status codes by their alias string.

## Testing

To run the tests, use PHPUnit:

```sh
composer test 
# or 
composer test -- --testdox

# details 
vendor/bin/phpunit --colors=always --testdox
```

## License

This project is licensed under the MIT License - see the LICENSE file for details.
