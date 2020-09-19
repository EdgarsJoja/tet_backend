<?php

namespace App\Console\Commands;

use App\Rss\FeedServiceInterface;
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
     * @var FeedServiceInterface
     */
    protected $exchangeRatesFeedService;

    /**
     * Create a new command instance.
     *
     * @param FeedServiceInterface $exchangeRatesFeedService
     */
    public function __construct(
        FeedServiceInterface $exchangeRatesFeedService
    ) {
        parent::__construct();

        $this->exchangeRatesFeedService = $exchangeRatesFeedService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->exchangeRatesFeedService->process();

        return 0;
    }
}
