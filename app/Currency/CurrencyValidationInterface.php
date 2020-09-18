<?php

namespace App\Currency;

use App\Currency;

/**
 * Interface CurrencyValidationInterface
 * @package App\Currency
 */
interface CurrencyValidationInterface
{
    /**
     * Validate currency object
     *
     * @param Currency $currency
     * @return bool
     */
    public function validate(Currency $currency): bool;
}
