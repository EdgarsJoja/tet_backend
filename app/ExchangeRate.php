<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExchangeRate
 * @package App
 */
class ExchangeRate extends Model
{
    /**
     * @var string
     */
    protected $table = 'exchange_rates';

    /**
     * @var string[]
     */
    protected $fillable = ['date', 'rate'];
}
