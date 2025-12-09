<?php

/**
 * Example 1: Basic Usage - Using HttpStatus (Combined Enum)
 * 
 * This example shows how to use the HttpStatus enum which combines
 * status code, text, and alias in a single enum.
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';

use JDZ\Utils\HttpStatus;

echo "=== Example 1: Basic Usage with HttpStatus ===\n\n";

// Get a status code
$status = HttpStatus::HTTP_200;

echo "Status Code: " . $status->value . "\n";
echo "Status Text: " . $status->getText() . "\n";
echo "Status Alias: " . $status->getAlias() . "\n\n";

// Common HTTP statuses
echo "--- Common HTTP Statuses ---\n";
$commonStatuses = [
    HttpStatus::HTTP_200,
    HttpStatus::HTTP_201,
    HttpStatus::HTTP_400,
    HttpStatus::HTTP_401,
    HttpStatus::HTTP_404,
    HttpStatus::HTTP_500,
];

foreach ($commonStatuses as $status) {
    printf(
        "%d - %s (%s)\n",
        $status->value,
        $status->getText(),
        $status->getAlias()
    );
}
