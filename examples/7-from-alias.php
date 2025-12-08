<?php

/**
 * Example 7: Using fromAlias() Method
 * 
 * This example demonstrates the fromAlias() method which allows you to
 * get an HttpStatus enum case from its alias string (e.g., 'HTTP_OK').
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';

use JDZ\Utils\HttpStatus;

echo "=== Example 7: Using fromAlias() ===\n\n";

// Get status from alias string
echo "1. Basic fromAlias() usage:\n";
$status = HttpStatus::fromAlias('HTTP_OK');
echo "   Alias: HTTP_OK\n";
echo "   Code: " . $status->value . "\n";
echo "   Text: " . $status->getText() . "\n";
echo "   Name: " . $status->name . "\n\n";

// Common aliases
echo "2. Common Status Aliases:\n";
$aliases = [
    'HTTP_OK',
    'HTTP_CREATED',
    'HTTP_NOT_FOUND',
    'HTTP_UNAUTHORIZED',
    'HTTP_FORBIDDEN',
    'HTTP_INTERNAL_SERVER_ERROR',
    'HTTP_SERVICE_UNAVAILABLE',
];

foreach ($aliases as $alias) {
    $status = HttpStatus::fromAlias($alias);
    printf("   %-35s → %d %s\n", $alias, $status->value, $status->getText());
}

// Using fromAlias vs fromName
echo "\n3. fromAlias() vs fromName():\n";

// fromAlias accepts the alias string
$statusFromAlias = HttpStatus::fromAlias('HTTP_NOT_FOUND');
echo "   fromAlias('HTTP_NOT_FOUND'): " . $statusFromAlias->value . " - " . $statusFromAlias->getText() . "\n";

// fromName accepts the enum case name
$statusFromName = HttpStatus::fromName('HTTP_404');
echo "   fromName('HTTP_404'): " . $statusFromName->value . " - " . $statusFromName->getText() . "\n";

// They can return the same result
echo "   Same result? " . ($statusFromAlias === $statusFromName ? "Yes" : "No") . "\n";

// fromAlias falls back to fromName
echo "\n4. fromAlias() Fallback:\n";
// If the exact alias is not found, it tries fromName
$status = HttpStatus::fromAlias('HTTP_200');
echo "   fromAlias('HTTP_200'): " . $status->value . " - " . $status->getText() . "\n";
echo "   (Falls back to fromName when alias not found)\n";

// Dynamic lookup with error handling
echo "\n5. Dynamic Lookup with Error Handling:\n";
$aliasesToTest = ['HTTP_OK', 'HTTP_NOT_FOUND', 'INVALID_ALIAS'];

foreach ($aliasesToTest as $alias) {
    try {
        $status = HttpStatus::fromAlias($alias);
        printf("   ✓ %s → %d %s\n", $alias, $status->value, $status->getText());
    } catch (\ValueError $e) {
        echo "   ✗ {$alias} → Not found\n";
    }
}

// Practical use case
echo "\n6. Practical Use Case - Configuration-Driven Responses:\n";

// Simulate configuration
$config = [
    'success' => 'HTTP_OK',
    'created' => 'HTTP_CREATED',
    'not_found' => 'HTTP_NOT_FOUND',
    'error' => 'HTTP_INTERNAL_SERVER_ERROR',
];

foreach ($config as $key => $alias) {
    $status = HttpStatus::fromAlias($alias);
    printf("   %s: %d - %s\n", $key, $status->value, $status->getText());
}

// Round-trip: status → alias → status
echo "\n7. Round-trip Conversion:\n";
$original = HttpStatus::HTTP_200;
$alias = $original->getAlias();
$retrieved = HttpStatus::fromAlias($alias);

echo "   Original: {$original->name} ({$original->value})\n";
echo "   Alias: {$alias}\n";
echo "   Retrieved: {$retrieved->name} ({$retrieved->value})\n";
echo "   Same instance? " . ($original === $retrieved ? "Yes" : "No") . "\n";
