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
    public function testEnumValues(): void
    {
        $this->assertEquals('OK', HttpStatusText::HTTP_200->value);
        $this->assertEquals('Not Found', HttpStatusText::HTTP_404->value);
        $this->assertEquals('Internal Server Error', HttpStatusText::HTTP_500->value);
        $this->assertEquals('Continue', HttpStatusText::HTTP_100->value);
        $this->assertEquals('Moved Permanently', HttpStatusText::HTTP_301->value);
    }

    public function testInformationalTexts(): void
    {
        $this->assertEquals('Continue', HttpStatusText::HTTP_100->value);
        $this->assertEquals('Switching Protocols', HttpStatusText::HTTP_101->value);
        $this->assertEquals('Processing', HttpStatusText::HTTP_102->value);
        $this->assertEquals('Early Hints', HttpStatusText::HTTP_103->value);
    }

    public function testSuccessfulTexts(): void
    {
        $this->assertEquals('OK', HttpStatusText::HTTP_200->value);
        $this->assertEquals('Created', HttpStatusText::HTTP_201->value);
        $this->assertEquals('Accepted', HttpStatusText::HTTP_202->value);
        $this->assertEquals('No Content', HttpStatusText::HTTP_204->value);
    }

    public function testRedirectionTexts(): void
    {
        $this->assertEquals('Moved Permanently', HttpStatusText::HTTP_301->value);
        $this->assertEquals('Found', HttpStatusText::HTTP_302->value);
        $this->assertEquals('Not Modified', HttpStatusText::HTTP_304->value);
        $this->assertEquals('Temporary Redirect', HttpStatusText::HTTP_307->value);
    }

    public function testClientErrorTexts(): void
    {
        $this->assertEquals('Bad Request', HttpStatusText::HTTP_400->value);
        $this->assertEquals('Unauthorized', HttpStatusText::HTTP_401->value);
        $this->assertEquals('Forbidden', HttpStatusText::HTTP_403->value);
        $this->assertEquals('Not Found', HttpStatusText::HTTP_404->value);
        $this->assertEquals('Unprocessable Entity', HttpStatusText::HTTP_422->value);
        $this->assertEquals('Too Many Requests', HttpStatusText::HTTP_429->value);
    }

    public function testServerErrorTexts(): void
    {
        $this->assertEquals('Internal Server Error', HttpStatusText::HTTP_500->value);
        $this->assertEquals('Not Implemented', HttpStatusText::HTTP_501->value);
        $this->assertEquals('Bad Gateway', HttpStatusText::HTTP_502->value);
        $this->assertEquals('Service Unavailable', HttpStatusText::HTTP_503->value);
    }

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

    public function testConversionRoundTrip(): void
    {
        // Start with HTTP_200
        $text = HttpStatusText::HTTP_200;
        $code = HttpStatusCode::fromHttpStatusText($text);
        $alias = HttpStatusAlias::fromHttpStatusText($text);
        
        // Convert back to text
        $textFromCode = HttpStatusText::fromHttpStatusCode($code);
        $textFromAlias = HttpStatusText::fromHttpStatusAlias($alias);
        
        $this->assertSame($text, $textFromCode);
        $this->assertSame($text, $textFromAlias);
    }

    public function testEnumCases(): void
    {
        $cases = HttpStatusText::cases();
        
        // Should have all status codes
        $this->assertGreaterThan(40, count($cases));
        
        // Check that they're all HttpStatusText instances
        foreach ($cases as $case) {
            $this->assertInstanceOf(HttpStatusText::class, $case);
            $this->assertIsString($case->value);
            $this->assertNotEmpty($case->value);
        }
    }

    public function testEnumName(): void
    {
        $this->assertEquals('HTTP_200', HttpStatusText::HTTP_200->name);
        $this->assertEquals('HTTP_404', HttpStatusText::HTTP_404->name);
        $this->assertEquals('HTTP_500', HttpStatusText::HTTP_500->name);
    }
}
