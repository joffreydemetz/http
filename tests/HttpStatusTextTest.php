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

class HttpStatusTextTest extends TestCase
{
    public function testFromName(): void
    {
        $status = HttpStatusText::fromName('HTTP_200');
        $this->assertSame(HttpStatusText::HTTP_200, $status);
        $this->assertEquals('OK', $status->value);

        $status = HttpStatusText::fromName('HTTP_404');
        $this->assertSame(HttpStatusText::HTTP_404, $status);
        $this->assertEquals('Not Found', $status->value);
    }

    public function testFromNameThrowsExceptionForInvalidName(): void
    {
        $this->expectException(\ValueError::class);
        HttpStatusText::fromName('INVALID_STATUS');
    }

    public function testFromHttpStatusCode(): void
    {
        $statusCode = HttpStatusCode::HTTP_200;
        $statusText = HttpStatusText::fromHttpStatusCode($statusCode);
        
        $this->assertSame(HttpStatusText::HTTP_200, $statusText);
        $this->assertEquals('OK', $statusText->value);
    }

    public function testFromHttpStatusAlias(): void
    {
        $statusAlias = HttpStatusAlias::HTTP_404;
        $statusText = HttpStatusText::fromHttpStatusAlias($statusAlias);
        
        $this->assertSame(HttpStatusText::HTTP_404, $statusText);
        $this->assertEquals('Not Found', $statusText->value);
    }
}
