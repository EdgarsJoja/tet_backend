<?php

namespace App\Currency;

use App\Currency;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface CurrencyRepositoryInterface
 * @package App\Currency
 */
interface CurrencyRepositoryInterface
{
    /**
     * Get currency by ID
     *
     * @param $id
     * @return Currency
     */
    public function getById($id): Currency;

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

    /**
     * Get list of currencies
     *
     * @return Collection
     */
    public function getList(): Collection;
}
