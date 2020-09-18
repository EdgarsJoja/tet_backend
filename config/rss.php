<?php

return [
    // Host of RSS feed API
    'host' => env('RSS_HOST', 'https://www.bank.lv'),
    // Path to RSS feed for currency exchange rates against Euro
    'exchange_rates_path' => env('RSS_EXCHANGE_RATES_PATH', 'vk/ecb_rss.xml'),
];
