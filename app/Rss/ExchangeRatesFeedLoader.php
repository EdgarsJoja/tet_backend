<?php

namespace App\Rss;

use SimpleXMLElement;

/**
 * Class ExchangeRatesFeedLoader
 * @package App\Rss
 */
class ExchangeRatesFeedLoader implements FeedLoaderInterface
{
    /**
     * @return SimpleXMLElement
     */
    public function load(): SimpleXMLElement
    {
        return simplexml_load_string(file_get_contents($this->getFeedUrl()));
    }

    /**
     * @return string
     */
    protected function getFeedUrl(): string
    {
        return sprintf('%s/%s', config('rss.host'), config('rss.exchange_rates_path'));
    }
}
