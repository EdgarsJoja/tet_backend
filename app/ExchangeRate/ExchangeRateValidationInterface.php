<?php

namespace App\ExchangeRate;

use App\ExchangeRate;

/**
 * Interface ExchangeRateValidationInterface
 * @package App\ExchangeRate
 */
interface ExchangeRateValidationInterface
{
    /**
     * @param ExchangeRate $exchangeRate
     * @return bool
     */
    public function validate(ExchangeRate $exchangeRate): bool;
}
