<?php

/**
 * Example 6: Working with All Status Categories
 * 
 * This example shows how to work with different HTTP status categories
 * (1xx, 2xx, 3xx, 4xx, 5xx) using both approaches.
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';

use JDZ\Utils\HttpStatus;
use JDZ\Utils\HttpStatusCode;
use JDZ\Utils\HttpStatusText;

echo "=== Example 6: All Status Categories ===\n\n";

// Using HttpStatus
echo "--- Using HttpStatus ---\n\n";

$categories = [
    '1xx Informational' => [HttpStatus::HTTP_100, HttpStatus::HTTP_101, HttpStatus::HTTP_102],
    '2xx Success' => [HttpStatus::HTTP_200, HttpStatus::HTTP_201, HttpStatus::HTTP_204],
    '3xx Redirection' => [HttpStatus::HTTP_301, HttpStatus::HTTP_302, HttpStatus::HTTP_304],
    '4xx Client Error' => [HttpStatus::HTTP_400, HttpStatus::HTTP_401, HttpStatus::HTTP_404],
    '5xx Server Error' => [HttpStatus::HTTP_500, HttpStatus::HTTP_502, HttpStatus::HTTP_503],
];

foreach ($categories as $category => $statuses) {
    echo "$category:\n";
    foreach ($statuses as $status) {
        printf("  %d - %s\n", $status->value, $status->getText());
    }
    echo "\n";
}

// Using separate enums
echo "--- Using Separate Enums ---\n\n";

$codeCategories = [
    '1xx Informational' => [HttpStatusCode::HTTP_100, HttpStatusCode::HTTP_101, HttpStatusCode::HTTP_102],
    '2xx Success' => [HttpStatusCode::HTTP_200, HttpStatusCode::HTTP_201, HttpStatusCode::HTTP_204],
    '3xx Redirection' => [HttpStatusCode::HTTP_301, HttpStatusCode::HTTP_302, HttpStatusCode::HTTP_304],
    '4xx Client Error' => [HttpStatusCode::HTTP_400, HttpStatusCode::HTTP_401, HttpStatusCode::HTTP_404],
    '5xx Server Error' => [HttpStatusCode::HTTP_500, HttpStatusCode::HTTP_502, HttpStatusCode::HTTP_503],
];

foreach ($codeCategories as $category => $codes) {
    echo "$category:\n";
    foreach ($codes as $code) {
        $text = HttpStatusText::fromHttpStatusCode($code);
        printf("  %d - %s\n", $code->value, $text->value);
    }
    echo "\n";
}

echo "✓ Both approaches handle all HTTP status categories identically!\n";
