<?php

/**
 * Example 4: Real-World API Response
 * 
 * This example shows how to use both approaches in a real API context.
 * 
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';

use JDZ\Utils\HttpStatus;
use JDZ\Utils\HttpStatusCode;
use JDZ\Utils\HttpStatusText;

echo "=== Example 4: API Response Examples ===\n\n";

// Example 1: Using HttpStatus
class ApiResponseWithHttpStatus
{
    public function __construct(
        private HttpStatus $status,
        private mixed $data = null
    ) {}

    public function send(): void
    {
        http_response_code($this->status->value);

        echo json_encode([
            'status' => $this->status->value,
            'message' => $this->status->getText(),
            'data' => $this->data
        ], JSON_PRETTY_PRINT) . "\n";
    }
}

// Example 2: Using separate enums
class ApiResponseWithSeparateEnums
{
    public function __construct(
        private HttpStatusCode $statusCode,
        private mixed $data = null
    ) {}

    public function send(): void
    {
        $statusText = HttpStatusText::fromHttpStatusCode($this->statusCode);
        http_response_code($this->statusCode->value);

        echo json_encode([
            'status' => $this->statusCode->value,
            'message' => $statusText->value,
            'data' => $this->data
        ], JSON_PRETTY_PRINT) . "\n";
    }
}

echo "--- Using HttpStatus ---\n";
$response1 = new ApiResponseWithHttpStatus(HttpStatus::HTTP_200, ['user' => 'John Doe']);
$response1->send();

echo "\n--- Using Separate Enums ---\n";
$response2 = new ApiResponseWithSeparateEnums(HttpStatusCode::HTTP_200, ['user' => 'John Doe']);
$response2->send();

echo "\n--- Error Response with HttpStatus ---\n";
$errorResponse1 = new ApiResponseWithHttpStatus(HttpStatus::HTTP_404);
$errorResponse1->send();

echo "\n--- Error Response with Separate Enums ---\n";
$errorResponse2 = new ApiResponseWithSeparateEnums(HttpStatusCode::HTTP_404);
$errorResponse2->send();

echo "\n✓ Both approaches produce identical API responses!\n";
