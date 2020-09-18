<?php

namespace App\Console\Commands;

use App\Currency\CurrencyRepositoryInterface;
use App\ExchangeRate\ExchangeRateRepositoryInterface;
use App\Rss\FeedLoaderInterface;
use App\Rss\FeedParserInterface;
use Illuminate\Console\Command;

/**
 * Class RssLoad
 * @package App\Console\Commands
 */
class RssLoad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tet:rss:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load and save into DB latest RSS feed for Euro exchange rates';

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
     * Create a new command instance.
     *
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
        parent::__construct();

        $this->exchangeRatesFeedLoader = $exchangeRatesFeedLoader;
        $this->exchangeRatesFeedParser = $exchangeRatesFeedParser;
        $this->currencyRepository = $currencyRepository;
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
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

        return 0;
    }
}
