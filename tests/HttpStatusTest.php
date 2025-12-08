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
    public function testEnumValues(): void
    {
        $this->assertEquals(200, HttpStatus::HTTP_200->value);
        $this->assertEquals(404, HttpStatus::HTTP_404->value);
        $this->assertEquals(500, HttpStatus::HTTP_500->value);
        $this->assertEquals(100, HttpStatus::HTTP_100->value);
        $this->assertEquals(301, HttpStatus::HTTP_301->value);
    }

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

    public function testInformationalStatuses(): void
    {
        $this->assertEquals(100, HttpStatus::HTTP_100->value);
        $this->assertEquals('Continue', HttpStatus::HTTP_100->getText());
        $this->assertEquals('HTTP_CONTINUE', HttpStatus::HTTP_100->getAlias());

        $this->assertEquals(101, HttpStatus::HTTP_101->value);
        $this->assertEquals('Switching Protocols', HttpStatus::HTTP_101->getText());
        $this->assertEquals('HTTP_SWITCHING_PROTOCOLS', HttpStatus::HTTP_101->getAlias());
    }

    public function testSuccessfulStatuses(): void
    {
        $this->assertEquals(200, HttpStatus::HTTP_200->value);
        $this->assertEquals('OK', HttpStatus::HTTP_200->getText());
        $this->assertEquals('HTTP_OK', HttpStatus::HTTP_200->getAlias());

        $this->assertEquals(201, HttpStatus::HTTP_201->value);
        $this->assertEquals('Created', HttpStatus::HTTP_201->getText());
        $this->assertEquals('HTTP_CREATED', HttpStatus::HTTP_201->getAlias());

        $this->assertEquals(204, HttpStatus::HTTP_204->value);
        $this->assertEquals('No Content', HttpStatus::HTTP_204->getText());
        $this->assertEquals('HTTP_NO_CONTENT', HttpStatus::HTTP_204->getAlias());
    }

    public function testRedirectionStatuses(): void
    {
        $this->assertEquals(301, HttpStatus::HTTP_301->value);
        $this->assertEquals('Moved Permanently', HttpStatus::HTTP_301->getText());
        $this->assertEquals('HTTP_MOVED_PERMANENTLY', HttpStatus::HTTP_301->getAlias());

        $this->assertEquals(302, HttpStatus::HTTP_302->value);
        $this->assertEquals('Found', HttpStatus::HTTP_302->getText());
        $this->assertEquals('HTTP_FOUND', HttpStatus::HTTP_302->getAlias());
    }

    public function testClientErrorStatuses(): void
    {
        $this->assertEquals(400, HttpStatus::HTTP_400->value);
        $this->assertEquals('Bad Request', HttpStatus::HTTP_400->getText());
        $this->assertEquals('HTTP_BAD_REQUEST', HttpStatus::HTTP_400->getAlias());

        $this->assertEquals(401, HttpStatus::HTTP_401->value);
        $this->assertEquals('Unauthorized', HttpStatus::HTTP_401->getText());
        $this->assertEquals('HTTP_UNAUTHORIZED', HttpStatus::HTTP_401->getAlias());

        $this->assertEquals(404, HttpStatus::HTTP_404->value);
        $this->assertEquals('Not Found', HttpStatus::HTTP_404->getText());
        $this->assertEquals('HTTP_NOT_FOUND', HttpStatus::HTTP_404->getAlias());
    }

    public function testServerErrorStatuses(): void
    {
        $this->assertEquals(500, HttpStatus::HTTP_500->value);
        $this->assertEquals('Internal Server Error', HttpStatus::HTTP_500->getText());
        $this->assertEquals('HTTP_INTERNAL_SERVER_ERROR', HttpStatus::HTTP_500->getAlias());

        $this->assertEquals(502, HttpStatus::HTTP_502->value);
        $this->assertEquals('Bad Gateway', HttpStatus::HTTP_502->getText());
        $this->assertEquals('HTTP_BAD_GATEWAY', HttpStatus::HTTP_502->getAlias());
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

    public function testEnumCases(): void
    {
        $cases = HttpStatus::cases();

        // Should have all status codes
        $this->assertGreaterThan(40, count($cases));

        // Check that they're all HttpStatus instances
        foreach ($cases as $case) {
            $this->assertInstanceOf(HttpStatus::class, $case);
            $this->assertIsInt($case->value);
            $this->assertGreaterThanOrEqual(100, $case->value);
            $this->assertLessThan(600, $case->value);
        }
    }

    public function testTextAndAliasConsistency(): void
    {
        // Ensure getText() and getAlias() return consistent values for all cases
        foreach (HttpStatus::cases() as $status) {
            $text = $status->getText();
            $alias = $status->getAlias();

            $this->assertIsString($text);
            $this->assertIsString($alias);
            $this->assertNotEmpty($text);
            $this->assertNotEmpty($alias);

            // Alias should start with HTTP_
            $this->assertStringStartsWith('HTTP_', $alias);
        }
    }

    public function testEnumName(): void
    {
        $this->assertEquals('HTTP_200', HttpStatus::HTTP_200->name);
        $this->assertEquals('HTTP_404', HttpStatus::HTTP_404->name);
        $this->assertEquals('HTTP_500', HttpStatus::HTTP_500->name);
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
