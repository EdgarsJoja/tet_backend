<?php

namespace App\Currency;

use App\Currency;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CurrencyRepository
 * @package App\Currency
 */
class CurrencyRepository implements CurrencyRepositoryInterface
{
    /**
     * @var CurrencyValidationInterface
     */
    protected $currencyValidation;

    /**
     * @param CurrencyValidationInterface $currencyValidation
     */
    public function __construct(CurrencyValidationInterface $currencyValidation)
    {
        $this->currencyValidation = $currencyValidation;
    }

    /**
     * Get currency by ID
     *
     * Note: Will throw exception if such entity does not exist.
     *
     * @param $id
     * @return Currency
     */
    public function getById($id): Currency
    {
        return Currency::findOrFail($id);
    }

    /**
     * Get currency object by code
     *
     * Note: Will return new entity instance if such doesn't exist already.
     *
     * @param string $code
     * @return Currency
     */
    public function getByCode(string $code): Currency
    {
        return Currency::firstOrNew(['code' => $code]);
    }

    /**
     * Save currency into DB
     *
     * @param Currency $currency
     * @return bool
     */
    public function save(Currency $currency): bool
    {
        if ($this->currencyValidation->validate($currency)) {
            $currency->save();

            return true;
        }

        return false;
    }

    /**
     * Get list of currencies
     *
     * @return Collection
     */
    public function getList(): Collection
    {
        // @todo: Replace with query builder to avoid loading all results every time
        return Currency::all();
    }
}

