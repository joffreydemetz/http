<?php

/**
 * @author    Joffrey Demetz <joffrey.demetz@gmail.com>
 * @license   MIT License; <https://opensource.org/licenses/MIT>
 */

namespace JDZ\Utils\Tests;

use JDZ\Utils\HttpStatusCode;
use JDZ\Utils\HttpStatusText;
use JDZ\Utils\HttpStatusAlias;
use PHPUnit\Framework\TestCase;

class HttpStatusCodeTest extends TestCase
{
    public function testEnumValues(): void
    {
        $this->assertEquals(200, HttpStatusCode::HTTP_200->value);
        $this->assertEquals(404, HttpStatusCode::HTTP_404->value);
        $this->assertEquals(500, HttpStatusCode::HTTP_500->value);
        $this->assertEquals(100, HttpStatusCode::HTTP_100->value);
        $this->assertEquals(301, HttpStatusCode::HTTP_301->value);
    }

    public function testInformationalCodes(): void
    {
        $this->assertEquals(100, HttpStatusCode::HTTP_100->value);
        $this->assertEquals(101, HttpStatusCode::HTTP_101->value);
        $this->assertEquals(102, HttpStatusCode::HTTP_102->value);
        $this->assertEquals(103, HttpStatusCode::HTTP_103->value);
    }

    public function testSuccessfulCodes(): void
    {
        $this->assertEquals(200, HttpStatusCode::HTTP_200->value);
        $this->assertEquals(201, HttpStatusCode::HTTP_201->value);
        $this->assertEquals(202, HttpStatusCode::HTTP_202->value);
        $this->assertEquals(204, HttpStatusCode::HTTP_204->value);
        $this->assertEquals(206, HttpStatusCode::HTTP_206->value);
    }

    public function testRedirectionCodes(): void
    {
        $this->assertEquals(301, HttpStatusCode::HTTP_301->value);
        $this->assertEquals(302, HttpStatusCode::HTTP_302->value);
        $this->assertEquals(304, HttpStatusCode::HTTP_304->value);
        $this->assertEquals(307, HttpStatusCode::HTTP_307->value);
        $this->assertEquals(308, HttpStatusCode::HTTP_308->value);
    }

    public function testClientErrorCodes(): void
    {
        $this->assertEquals(400, HttpStatusCode::HTTP_400->value);
        $this->assertEquals(401, HttpStatusCode::HTTP_401->value);
        $this->assertEquals(403, HttpStatusCode::HTTP_403->value);
        $this->assertEquals(404, HttpStatusCode::HTTP_404->value);
        $this->assertEquals(422, HttpStatusCode::HTTP_422->value);
        $this->assertEquals(429, HttpStatusCode::HTTP_429->value);
    }

    public function testServerErrorCodes(): void
    {
        $this->assertEquals(500, HttpStatusCode::HTTP_500->value);
        $this->assertEquals(501, HttpStatusCode::HTTP_501->value);
        $this->assertEquals(502, HttpStatusCode::HTTP_502->value);
        $this->assertEquals(503, HttpStatusCode::HTTP_503->value);
        $this->assertEquals(504, HttpStatusCode::HTTP_504->value);
    }

    public function testFromName(): void
    {
        $status = HttpStatusCode::fromName('HTTP_200');
        $this->assertSame(HttpStatusCode::HTTP_200, $status);
        $this->assertEquals(200, $status->value);

        $status = HttpStatusCode::fromName('HTTP_404');
        $this->assertSame(HttpStatusCode::HTTP_404, $status);
        $this->assertEquals(404, $status->value);
    }

    public function testFromNameThrowsExceptionForInvalidName(): void
    {
        $this->expectException(\ValueError::class);
        HttpStatusCode::fromName('INVALID_STATUS');
    }

    public function testFromHttpStatusText(): void
    {
        $statusText = HttpStatusText::HTTP_200;
        $statusCode = HttpStatusCode::fromHttpStatusText($statusText);

        $this->assertSame(HttpStatusCode::HTTP_200, $statusCode);
        $this->assertEquals(200, $statusCode->value);
    }

    public function testFromHttpStatusAlias(): void
    {
        $statusAlias = HttpStatusAlias::HTTP_404;
        $statusCode = HttpStatusCode::fromHttpStatusAlias($statusAlias);

        $this->assertSame(HttpStatusCode::HTTP_404, $statusCode);
        $this->assertEquals(404, $statusCode->value);
    }

    public function testConversionRoundTrip(): void
    {
        // Start with HTTP_200
        $code = HttpStatusCode::HTTP_200;
        $text = HttpStatusText::fromHttpStatusCode($code);
        $alias = HttpStatusAlias::fromHttpStatusCode($code);

        // Convert back to code
        $codeFromText = HttpStatusCode::fromHttpStatusText($text);
        $codeFromAlias = HttpStatusCode::fromHttpStatusAlias($alias);

        $this->assertSame($code, $codeFromText);
        $this->assertSame($code, $codeFromAlias);
    }

    public function testEnumCases(): void
    {
        $cases = HttpStatusCode::cases();

        // Should have all status codes
        $this->assertGreaterThan(40, count($cases));

        // Check that they're all HttpStatusCode instances
        foreach ($cases as $case) {
            $this->assertInstanceOf(HttpStatusCode::class, $case);
            $this->assertIsInt($case->value);
            $this->assertGreaterThanOrEqual(100, $case->value);
            $this->assertLessThan(600, $case->value);
        }
    }

    public function testEnumName(): void
    {
        $this->assertEquals('HTTP_200', HttpStatusCode::HTTP_200->name);
        $this->assertEquals('HTTP_404', HttpStatusCode::HTTP_404->name);
        $this->assertEquals('HTTP_500', HttpStatusCode::HTTP_500->name);
    }
}
