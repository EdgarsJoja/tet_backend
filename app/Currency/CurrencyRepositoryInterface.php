<?php

namespace App\Currency;

use App\Currency;

/**
 * Interface CurrencyRepositoryInterface
 * @package App\Currency
 */
interface CurrencyRepositoryInterface
{
    /**
     * Get currency object by code
     *
     * @param string $code
     * @return Currency
     */
    public function getByCode(string $code): Currency;

    /**
     * Save currency into DB
     *
     * @param Currency $currency
     * @return bool
     */
    public function save(Currency $currency): bool;
}
