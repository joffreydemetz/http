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
}
