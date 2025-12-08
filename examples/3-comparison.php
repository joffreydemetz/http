<?php

/**
 * Example 3: Side-by-Side Comparison
 * 
 * This example demonstrates that HttpStatus and the three separate enums
 * produce identical results, just with different API approaches.
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';

use JDZ\Utils\HttpStatus;
use JDZ\Utils\HttpStatusCode;
use JDZ\Utils\HttpStatusText;
use JDZ\Utils\HttpStatusAlias;

echo "=== Example 3: Side-by-Side Comparison ===\n\n";

// Approach 1: Using HttpStatus (all-in-one)
echo "--- Approach 1: HttpStatus (Combined) ---\n";
$status = HttpStatus::HTTP_404;
echo "Code: " . $status->value . "\n";
echo "Text: " . $status->getText() . "\n";
echo "Alias: " . $status->getAlias() . "\n\n";

// Approach 2: Using separate enums
echo "--- Approach 2: Separate Enums ---\n";
$code = HttpStatusCode::HTTP_404;
$text = HttpStatusText::HTTP_404;
$alias = HttpStatusAlias::HTTP_404;
echo "Code: " . $code->value . "\n";
echo "Text: " . $text->value . "\n";
echo "Alias: " . $alias->value . "\n\n";

// Approach 3: Using separate enums with conversion
echo "--- Approach 3: Separate Enums with Conversion ---\n";
$code = HttpStatusCode::HTTP_404;
$text = HttpStatusText::fromHttpStatusCode($code);
$alias = HttpStatusAlias::fromHttpStatusCode($code);
echo "Code: " . $code->value . "\n";
echo "Text: " . $text->value . "\n";
echo "Alias: " . $alias->value . "\n\n";

echo "✓ All three approaches produce the same output!\n";
