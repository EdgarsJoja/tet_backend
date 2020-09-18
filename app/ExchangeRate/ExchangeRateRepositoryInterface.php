<?php

namespace App\ExchangeRate;

use App\Currency;
use App\ExchangeRate;

/**
 * Interface ExchangeRateRepositoryInterface
 * @package App\ExchangeRate
 */
interface ExchangeRateRepositoryInterface
{
    /**
     * @param Currency $currency
     * @param array $data
     * @return bool
     */
    public function saveCurrencyExchangeRate(Currency $currency, array $data): bool;
}
