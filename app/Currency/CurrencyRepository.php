<?php

namespace App\Currency;

use App\Currency;

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
     * Get currency object by code
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
}

