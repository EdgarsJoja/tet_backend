<?php

namespace App\Providers;

use App\Console\Commands\RssLoad;
use App\Currency\CurrencyRepository;
use App\Currency\CurrencyRepositoryInterface;
use App\Currency\CurrencyValidation;
use App\Currency\CurrencyValidationInterface;
use App\ExchangeRate\ExchangeRateRepository;
use App\ExchangeRate\ExchangeRateRepositoryInterface;
use App\ExchangeRate\ExchangeRateValidation;
use App\ExchangeRate\ExchangeRateValidationInterface;
use App\Rss\ExchangeRatesFeedLoader;
use App\Rss\ExchangeRatesFeedParser;
use App\Rss\FeedLoaderInterface;
use App\Rss\FeedParserInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Bind concrete implementations for given abstractions
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(CurrencyValidationInterface::class, CurrencyValidation::class);

        $this->app->bind(ExchangeRateRepositoryInterface::class, ExchangeRateRepository::class);
        $this->app->bind(ExchangeRateValidationInterface::class, ExchangeRateValidation::class);

        $this->app->when(RssLoad::class)
            ->needs(FeedLoaderInterface::class)
            ->give(ExchangeRatesFeedLoader::class);

        $this->app->when(RssLoad::class)
            ->needs(FeedParserInterface::class)
            ->give(ExchangeRatesFeedParser::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
