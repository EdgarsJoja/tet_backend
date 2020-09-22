<?php

namespace Tests\Unit\Currency;

use App\Currency;
use App\Currency\CurrencyValidation;
use Tests\TestCase;

/**
 * Class ValidationTest
 * @package Tests\Unit\Currency
 *
 * @covers \App\Currency\CurrencyValidation
 */
class ValidationTest extends TestCase
{
    /**
     * Test valid currency object
     */
    public function testCurrencyIsValid(): void
    {
        $currency = factory(Currency::class)->make(['code' => 'ABC']);
        $validation = new CurrencyValidation();

        self::assertTrue($validation->validate($currency));
    }

    /**
     * Test invalid currency object
     */
    public function testCurrencyInvalid(): void
    {
        $currency = factory(Currency::class)->make();
        $validation = new CurrencyValidation();

        self::assertFalse($validation->validate($currency));
    }
}
