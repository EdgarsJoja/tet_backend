<?php

namespace App\Rss;

use App\Currency\CurrencyRepositoryInterface;
use App\ExchangeRate\ExchangeRateRepositoryInterface;

/**
 * Class ExchangeRatesFeedService
 * @package App\Rss
 *
 * Wrapper class for loading, processing & saving exchange rates RSS feed
 */
class ExchangeRatesFeedService implements FeedServiceInterface
{
    /**
     * @var FeedLoaderInterface
     */
    protected $exchangeRatesFeedLoader;

    /**
     * @var FeedParserInterface
     */
    protected $exchangeRatesFeedParser;

    /**
     * @var CurrencyRepositoryInterface
     */
    protected $currencyRepository;

    /**
     * @var ExchangeRateRepositoryInterface
     */
    protected $exchangeRateRepository;

    /**
     * ExchangeRatesFeedService constructor.
     * @param FeedLoaderInterface $exchangeRatesFeedLoader
     * @param FeedParserInterface $exchangeRatesFeedParser
     * @param CurrencyRepositoryInterface $currencyRepository
     * @param ExchangeRateRepositoryInterface $exchangeRateRepository
     */
    public function __construct(
        FeedLoaderInterface $exchangeRatesFeedLoader,
        FeedParserInterface $exchangeRatesFeedParser,
        CurrencyRepositoryInterface $currencyRepository,
        ExchangeRateRepositoryInterface $exchangeRateRepository
    ) {
        $this->exchangeRatesFeedLoader = $exchangeRatesFeedLoader;
        $this->exchangeRatesFeedParser = $exchangeRatesFeedParser;
        $this->currencyRepository = $currencyRepository;
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    /**
     * Process RSS feed
     *
     * @return mixed
     */
    public function process()
    {
        $xml = $this->exchangeRatesFeedLoader->load();
        $dataArray = $this->exchangeRatesFeedParser->parse($xml);

        foreach ($dataArray as $data) {
            if (isset($data['rates']) && is_array($data['rates'])) {
                foreach ($data['rates'] as $currencyCode => $exchangeRate) {
                    $currency = $this->currencyRepository->getByCode($currencyCode);
                    $this->currencyRepository->save($currency);

                    $this->exchangeRateRepository->saveCurrencyExchangeRate($currency, [
                        'date' => $data['date'],
                        'rate' => $exchangeRate
                    ]);
                }
            }
        }
    }
}
