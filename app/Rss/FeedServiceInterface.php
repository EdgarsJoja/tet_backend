<?php

namespace App\Rss;

/**
 * Interface FeedServiceInterface
 * @package App\Rss
 */
interface FeedServiceInterface
{
    /**
     * Process RSS feed
     *
     * @return mixed
     */
    public function process();
}
