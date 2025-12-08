<?php

/**
 * Example 2: Using Separate Enums
 * 
 * This example shows how to use HttpStatusCode, HttpStatusText,
 * and HttpStatusAlias separately to achieve the same results as HttpStatus.
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';

use JDZ\Utils\HttpStatusCode;
use JDZ\Utils\HttpStatusText;
use JDZ\Utils\HttpStatusAlias;

echo "=== Example 2: Using Separate Enums ===\n\n";

// Using three separate enums for the same status
$statusCode = HttpStatusCode::HTTP_200;
$statusText = HttpStatusText::HTTP_200;
$statusAlias = HttpStatusAlias::HTTP_200;

echo "Status Code: " . $statusCode->value . "\n";
echo "Status Text: " . $statusText->value . "\n";
echo "Status Alias: " . $statusAlias->value . "\n\n";

// Common HTTP statuses using separate enums
echo "--- Common HTTP Statuses (Separate Enums) ---\n";
$codes = [
    HttpStatusCode::HTTP_200,
    HttpStatusCode::HTTP_201,
    HttpStatusCode::HTTP_400,
    HttpStatusCode::HTTP_401,
    HttpStatusCode::HTTP_404,
    HttpStatusCode::HTTP_500,
];

foreach ($codes as $code) {
    $text = HttpStatusText::fromHttpStatusCode($code);
    $alias = HttpStatusAlias::fromHttpStatusCode($code);

    printf(
        "%d - %s (%s)\n",
        $code->value,
        $text->value,
        $alias->value
    );
}
