<?php

namespace App\Currency;

use App\Currency;

/**
 * Class CurrencyValidation
 * @package App\Currency
 */
class CurrencyValidation implements CurrencyValidationInterface
{
    /**
     * Validate currency object
     *
     * @param Currency $currency
     * @return bool
     */
    public function validate(Currency $currency): bool
    {
        return isset($currency->code);
    }
}
