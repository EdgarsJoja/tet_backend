<?php

namespace App\Rss;

use SimpleXMLElement;

/**
 * Interface FeedLoaderInterface
 * @package App\Rss
 */
interface FeedLoaderInterface
{
    /**
     * Load & return xml of RSS feed
     *
     * @return SimpleXMLElement
     */
    public function load(): SimpleXMLElement;
}
