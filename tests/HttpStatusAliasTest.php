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

class HttpStatusAliasTest extends TestCase
{
    public function testEnumValues(): void
    {
        $this->assertEquals('HTTP_OK', HttpStatusAlias::HTTP_200->value);
        $this->assertEquals('HTTP_NOT_FOUND', HttpStatusAlias::HTTP_404->value);
        $this->assertEquals('HTTP_INTERNAL_SERVER_ERROR', HttpStatusAlias::HTTP_500->value);
        $this->assertEquals('HTTP_CONTINUE', HttpStatusAlias::HTTP_100->value);
        $this->assertEquals('HTTP_MOVED_PERMANENTLY', HttpStatusAlias::HTTP_301->value);
    }

    public function testInformationalAliases(): void
    {
        $this->assertEquals('HTTP_CONTINUE', HttpStatusAlias::HTTP_100->value);
        $this->assertEquals('HTTP_SWITCHING_PROTOCOLS', HttpStatusAlias::HTTP_101->value);
        $this->assertEquals('HTTP_PROCESSING', HttpStatusAlias::HTTP_102->value);
        $this->assertEquals('HTTP_EARLY_HINTS', HttpStatusAlias::HTTP_103->value);
    }

    public function testSuccessfulAliases(): void
    {
        $this->assertEquals('HTTP_OK', HttpStatusAlias::HTTP_200->value);
        $this->assertEquals('HTTP_CREATED', HttpStatusAlias::HTTP_201->value);
        $this->assertEquals('HTTP_ACCEPTED', HttpStatusAlias::HTTP_202->value);
        $this->assertEquals('HTTP_NO_CONTENT', HttpStatusAlias::HTTP_204->value);
    }

    public function testRedirectionAliases(): void
    {
        $this->assertEquals('HTTP_MOVED_PERMANENTLY', HttpStatusAlias::HTTP_301->value);
        $this->assertEquals('HTTP_FOUND', HttpStatusAlias::HTTP_302->value);
        $this->assertEquals('HTTP_NOT_MODIFIED', HttpStatusAlias::HTTP_304->value);
        $this->assertEquals('HTTP_TEMPORARY_REDIRECT', HttpStatusAlias::HTTP_307->value);
    }

    public function testClientErrorAliases(): void
    {
        $this->assertEquals('HTTP_BAD_REQUEST', HttpStatusAlias::HTTP_400->value);
        $this->assertEquals('HTTP_UNAUTHORIZED', HttpStatusAlias::HTTP_401->value);
        $this->assertEquals('HTTP_FORBIDDEN', HttpStatusAlias::HTTP_403->value);
        $this->assertEquals('HTTP_NOT_FOUND', HttpStatusAlias::HTTP_404->value);
        $this->assertEquals('HTTP_UNPROCESSABLE_ENTITY', HttpStatusAlias::HTTP_422->value);
        $this->assertEquals('HTTP_TOO_MANY_REQUESTS', HttpStatusAlias::HTTP_429->value);
    }

    public function testServerErrorAliases(): void
    {
        $this->assertEquals('HTTP_INTERNAL_SERVER_ERROR', HttpStatusAlias::HTTP_500->value);
        $this->assertEquals('HTTP_NOT_IMPLEMENTED', HttpStatusAlias::HTTP_501->value);
        $this->assertEquals('HTTP_BAD_GATEWAY', HttpStatusAlias::HTTP_502->value);
        $this->assertEquals('HTTP_SERVICE_UNAVAILABLE', HttpStatusAlias::HTTP_503->value);
    }

    public function testFromName(): void
    {
        $status = HttpStatusAlias::fromName('HTTP_200');
        $this->assertSame(HttpStatusAlias::HTTP_200, $status);
        $this->assertEquals('HTTP_OK', $status->value);

        $status = HttpStatusAlias::fromName('HTTP_404');
        $this->assertSame(HttpStatusAlias::HTTP_404, $status);
        $this->assertEquals('HTTP_NOT_FOUND', $status->value);
    }

    public function testFromNameThrowsExceptionForInvalidName(): void
    {
        $this->expectException(\ValueError::class);
        HttpStatusAlias::fromName('INVALID_STATUS');
    }

    public function testFromHttpStatusCode(): void
    {
        $statusCode = HttpStatusCode::HTTP_200;
        $statusAlias = HttpStatusAlias::fromHttpStatusCode($statusCode);

        $this->assertSame(HttpStatusAlias::HTTP_200, $statusAlias);
        $this->assertEquals('HTTP_OK', $statusAlias->value);
    }

    public function testFromHttpStatusText(): void
    {
        $statusText = HttpStatusText::HTTP_404;
        $statusAlias = HttpStatusAlias::fromHttpStatusText($statusText);

        $this->assertSame(HttpStatusAlias::HTTP_404, $statusAlias);
        $this->assertEquals('HTTP_NOT_FOUND', $statusAlias->value);
    }

    public function testConversionRoundTrip(): void
    {
        // Start with HTTP_200
        $alias = HttpStatusAlias::HTTP_200;
        $code = HttpStatusCode::fromHttpStatusAlias($alias);
        $text = HttpStatusText::fromHttpStatusAlias($alias);

        // Convert back to alias
        $aliasFromCode = HttpStatusAlias::fromHttpStatusCode($code);
        $aliasFromText = HttpStatusAlias::fromHttpStatusText($text);

        $this->assertSame($alias, $aliasFromCode);
        $this->assertSame($alias, $aliasFromText);
    }

    public function testEnumCases(): void
    {
        $cases = HttpStatusAlias::cases();

        // Should have all status codes
        $this->assertGreaterThan(40, count($cases));

        // Check that they're all HttpStatusAlias instances
        foreach ($cases as $case) {
            $this->assertInstanceOf(HttpStatusAlias::class, $case);
            $this->assertIsString($case->value);
            $this->assertStringStartsWith('HTTP_', $case->value);
        }
    }

    public function testEnumName(): void
    {
        $this->assertEquals('HTTP_200', HttpStatusAlias::HTTP_200->name);
        $this->assertEquals('HTTP_404', HttpStatusAlias::HTTP_404->name);
        $this->assertEquals('HTTP_500', HttpStatusAlias::HTTP_500->name);
    }

    public function testTeapotCase(): void
    {
        // HTTP_418 exists in HttpStatusAlias
        $this->assertEquals('HTTP_I_AM_A_TEAPOT', HttpStatusAlias::HTTP_418->value);
    }
}
