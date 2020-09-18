<?php

namespace App\ExchangeRate;

use App\ExchangeRate;

/**
 * Class ExchangeRateValidation
 * @package App\ExchangeRate
 */
class ExchangeRateValidation implements ExchangeRateValidationInterface
{
    /**
     * @param ExchangeRate $exchangeRate
     * @return bool
     */
    public function validate(ExchangeRate $exchangeRate): bool
    {
        return isset($exchangeRate->date, $exchangeRate->rate, $exchangeRate->currency_id) && $exchangeRate->rate > 0;
    }
}
