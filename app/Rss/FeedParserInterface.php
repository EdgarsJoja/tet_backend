<?php

namespace App\Rss;

use SimpleXMLElement;

/**
 * Interface FeedParserInterface
 * @package App\Rss
 */
interface FeedParserInterface
{
    /**
     * Parses xml RSS feed to needed array data
     *
     * @param SimpleXMLElement $xml
     * @return array
     */
    public function parse(SimpleXMLElement $xml): array;
}
