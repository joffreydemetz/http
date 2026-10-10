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

    public function testTeapotCase(): void
    {
        // HTTP_418 exists in HttpStatusAlias
        $this->assertEquals('HTTP_I_AM_A_TEAPOT', HttpStatusAlias::HTTP_418->value);
    }
}
