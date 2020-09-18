<?php

namespace App\ExchangeRate;

use App\Currency;
use App\ExchangeRate;

/**
 * Class ExchangeRateRepository
 * @package App\ExchangeRate
 */
class ExchangeRateRepository implements ExchangeRateRepositoryInterface
{
    /**
     * @var ExchangeRateValidationInterface
     */
    protected $exchangeRateValidation;

    /**
     * ExchangeRateRepository constructor.
     * @param ExchangeRateValidationInterface $exchangeRateValidation
     */
    public function __construct(ExchangeRateValidationInterface $exchangeRateValidation)
    {
        $this->exchangeRateValidation = $exchangeRateValidation;
    }

    /**
     * @param Currency $currency
     * @param array $data
     * @return bool
     */
    public function saveCurrencyExchangeRate(Currency $currency, array $data): bool
    {
        if (isset($data['date'])) {
            /** @var ExchangeRate $exchangeRate */
            $exchangeRate =  $currency->exchangeRates()->firstOrNew(['date' => $data['date']], $data);

            if ($this->exchangeRateValidation->validate($exchangeRate)) {
                return $exchangeRate->save();
            }
        }

        return false;
    }
}
