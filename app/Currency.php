<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Currency
 * @package App
 */
class Currency extends Model
{
    /**
     * @var string
     */
    protected $table = 'currencies';

    /**
     * @var string[]
     */
    protected $fillable = ['code'];

    /**
     * @var string[]
     */
    protected $visible = ['id', 'code'];

    /**
     * Get all corresponding exchange rates
     *
     * @return HasMany
     */
    public function exchangeRates(): HasMany
    {
        return $this->hasMany(ExchangeRate::class);
    }

    /**
     * Get last exchange rate by date
     *
     * @return ExchangeRate
     */
    public function lastExchangeRate(): ExchangeRate
    {
        /** @var ExchangeRate $exchangeRate */
        $exchangeRate = $this->exchangeRates()->latest('date')->first();

        return $exchangeRate;
    }
}
