<?php

/**
 * @author    Joffrey Demetz <joffrey.demetz@gmail.com>
 * @license   MIT License; <https://opensource.org/licenses/MIT>
 */

namespace JDZ\Utils\Tests;

use JDZ\Utils\HttpStatus;
use PHPUnit\Framework\TestCase;

class HttpStatusTest extends TestCase
{
    public function testGetText(): void
    {
        $this->assertEquals('OK', HttpStatus::HTTP_200->getText());
        $this->assertEquals('Not Found', HttpStatus::HTTP_404->getText());
        $this->assertEquals('Internal Server Error', HttpStatus::HTTP_500->getText());
        $this->assertEquals('Continue', HttpStatus::HTTP_100->getText());
        $this->assertEquals('Moved Permanently', HttpStatus::HTTP_301->getText());
    }

    public function testGetAlias(): void
    {
        $this->assertEquals('HTTP_OK', HttpStatus::HTTP_200->getAlias());
        $this->assertEquals('HTTP_NOT_FOUND', HttpStatus::HTTP_404->getAlias());
        $this->assertEquals('HTTP_INTERNAL_SERVER_ERROR', HttpStatus::HTTP_500->getAlias());
        $this->assertEquals('HTTP_CONTINUE', HttpStatus::HTTP_100->getAlias());
        $this->assertEquals('HTTP_MOVED_PERMANENTLY', HttpStatus::HTTP_301->getAlias());
    }

    public function testFromName(): void
    {
        $status = HttpStatus::fromName('HTTP_200');
        $this->assertSame(HttpStatus::HTTP_200, $status);
        $this->assertEquals(200, $status->value);
        $this->assertEquals('OK', $status->getText());
        $this->assertEquals('HTTP_OK', $status->getAlias());
    }

    public function testFromNameThrowsExceptionForInvalidName(): void
    {
        $this->expectException(\ValueError::class);
        HttpStatus::fromName('INVALID_STATUS');
    }

    public function testFromAlias(): void
    {
        $status = HttpStatus::fromAlias('HTTP_OK');
        $this->assertSame(HttpStatus::HTTP_200, $status);
        $this->assertEquals(200, $status->value);
        $this->assertEquals('OK', $status->getText());

        $status = HttpStatus::fromAlias('HTTP_NOT_FOUND');
        $this->assertSame(HttpStatus::HTTP_404, $status);
        $this->assertEquals(404, $status->value);
        $this->assertEquals('Not Found', $status->getText());

        $status = HttpStatus::fromAlias('HTTP_INTERNAL_SERVER_ERROR');
        $this->assertSame(HttpStatus::HTTP_500, $status);
        $this->assertEquals(500, $status->value);
    }

    public function testFromAliasFallsBackToFromName(): void
    {
        // fromAlias should fall back to fromName if alias not found
        $status = HttpStatus::fromAlias('HTTP_200');
        $this->assertSame(HttpStatus::HTTP_200, $status);
    }

    public function testFromAliasThrowsExceptionForInvalidAlias(): void
    {
        $this->expectException(\ValueError::class);
        HttpStatus::fromAlias('INVALID_ALIAS');
    }

    public function testFromAliasWithAllStatuses(): void
    {
        // Test that fromAlias works for all status codes
        foreach (HttpStatus::cases() as $status) {
            $alias = $status->getAlias();
            $retrieved = HttpStatus::fromAlias($alias);
            $this->assertSame($status, $retrieved, "fromAlias should work for {$status->name}");
        }
    }

    public function testHttp104Case(): void
    {
        // HTTP_104 is a newer status code
        $this->assertEquals(104, HttpStatus::HTTP_104->value);
        $this->assertEquals('Upload Resumption Supported (TEMPORARY)', HttpStatus::HTTP_104->getText());
        $this->assertEquals('HTTP_UPLOAD_RESUMPTION_SUPPORTED', HttpStatus::HTTP_104->getAlias());
    }

    public function testAllStatusCodesHaveTextAndAlias(): void
    {
        // Verify every status code has both text and alias
        foreach (HttpStatus::cases() as $status) {
            $text = $status->getText();
            $alias = $status->getAlias();

            $this->assertNotEmpty($text, "Status {$status->name} should have text");
            $this->assertNotEmpty($alias, "Status {$status->name} should have alias");
            $this->assertStringStartsWith('HTTP_', $alias, "Alias for {$status->name} should start with HTTP_");
        }
    }
}
