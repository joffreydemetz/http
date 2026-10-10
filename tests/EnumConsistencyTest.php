<?php

namespace JDZ\Utils\Tests;

use JDZ\Utils\HttpStatus;
use JDZ\Utils\HttpStatusAlias;
use JDZ\Utils\HttpStatusCode;
use JDZ\Utils\HttpStatusText;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * HttpStatus carries the code, its text and its alias; HttpStatusCode, HttpStatusText
 * and HttpStatusAlias hold the same statuses one value each, and the from*() helpers
 * convert between them by case name. A status missing from one enum, or a text that
 * drifted, only shows up as a ValueError at run time: this test keeps them in step.
 */
class EnumConsistencyTest extends TestCase
{
    public static function statuses(): iterable
    {
        foreach (HttpStatus::cases() as $status) {
            yield $status->name => [$status];
        }
    }

    #[DataProvider('statuses')]
    public function testEveryStatusHasTheSameValuesInTheThreeValueEnums(HttpStatus $status): void
    {
        $this->assertSame(
            [$status->value, $status->getText(), $status->getAlias()],
            [
                HttpStatusCode::fromName($status->name)->value,
                HttpStatusText::fromName($status->name)->value,
                HttpStatusAlias::fromName($status->name)->value,
            ]
        );
    }

    public function testTheValueEnumsHoldNoOtherStatus(): void
    {
        $names = array_column(HttpStatus::cases(), 'name');

        foreach ([HttpStatusCode::class, HttpStatusText::class, HttpStatusAlias::class] as $enum) {
            $this->assertSame($names, array_column($enum::cases(), 'name'), $enum);
        }
    }
}
