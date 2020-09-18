<?php

namespace App\Rss;

use Illuminate\Support\Facades\Date;
use SimpleXMLElement;

/**
 * Class ExchangeRatesFeedParser
 * @package App\Rss
 */
class ExchangeRatesFeedParser implements FeedParserInterface
{
    /**
     * Parses xml RSS feed to needed array data
     *
     * @param SimpleXMLElement $xml
     * @return array
     */
    public function parse(SimpleXMLElement $xml): array
    {
        $result = [];

        if (isset($xml->channel->item)) {
            foreach ($xml->channel->item as $item) {
                $result[] = [
                    'date' => $this->transformDate((string)$item->pubDate),
                    'rates' => $this->transformRatesStringToArray((string)$item->description),
                ];
            }
        }

        return $result;
    }

    /**
     * Transform into Y-m-d format
     *
     * @param string $dateTime
     * @return string
     */
    protected function transformDate(string $dateTime): string
    {
        return Date::createFromTimeString($dateTime)->format('Y-m-d');
    }

    /**
     * Transform whitespace separated currency codes and exchange rates into associative array
     *
     * @param string $rates
     * @return array
     */
    protected function transformRatesStringToArray(string $rates): array
    {
        $result = [];

        // Split into array by one or more spaces between data
        $flatArray = preg_split('/\s+/', $rates);

        if ($flatArray) {
            // Split into pairs by 2, where each sub-array is currency with it's exchange rate
            $pairsArray = array_filter(array_chunk($flatArray, 2), static function ($item) {
                // Remove any other data, that is not in pair format
                return count($item) === 2;
            });

            foreach ($pairsArray as [0 => $currencyCode, 1 => $exchangeRate]) {
                $result[$currencyCode] = $exchangeRate;
            }
        }

        return $result;
    }
}
