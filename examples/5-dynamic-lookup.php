<?php

/**
 * Example 5: Dynamic Lookup with fromName()
 * 
 * This example shows how to dynamically look up status codes
 * using the fromName() method in both approaches.
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';

use JDZ\Utils\HttpStatus;
use JDZ\Utils\HttpStatusCode;
use JDZ\Utils\HttpStatusText;

echo "=== Example 5: Dynamic Lookup ===\n\n";

// Using HttpStatus
echo "--- Using HttpStatus::fromName() ---\n";
try {
    $status = HttpStatus::fromName('HTTP_200');
    echo "Found: " . $status->value . " - " . $status->getText() . "\n";

    $status = HttpStatus::fromName('HTTP_404');
    echo "Found: " . $status->value . " - " . $status->getText() . "\n";
} catch (\ValueError $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n--- Using HttpStatusCode::fromName() ---\n";
try {
    $code = HttpStatusCode::fromName('HTTP_200');
    $text = HttpStatusText::fromHttpStatusCode($code);
    echo "Found: " . $code->value . " - " . $text->value . "\n";

    $code = HttpStatusCode::fromName('HTTP_404');
    $text = HttpStatusText::fromHttpStatusCode($code);
    echo "Found: " . $code->value . " - " . $text->value . "\n";
} catch (\ValueError $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n--- Handling Invalid Lookup ---\n";
try {
    $status = HttpStatus::fromName('HTTP_999');
} catch (\ValueError $e) {
    echo "✓ HttpStatus - Caught error: Status not found\n";
}

try {
    $code = HttpStatusCode::fromName('HTTP_999');
} catch (\ValueError $e) {
    echo "✓ HttpStatusCode - Caught error: Status not found\n";
}

echo "\n✓ Both approaches handle dynamic lookup identically!\n";
