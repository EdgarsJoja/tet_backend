<?php

namespace App\Http\Controllers\Api\V1;

use App\Currency;
use App\Currency\CurrencyRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CurrencyListController
 * @package App\Http\Controllers\Api\V1
 */
class CurrencyListController extends Controller
{
    /**
     * Page size for results
     */
    protected const PAGE_SIZE = 5;

    /**
     * @var CurrencyRepositoryInterface
     */
    protected $currencyRepository;

    /**
     * CurrencyListController constructor.
     * @param CurrencyRepositoryInterface $currencyRepository
     */
    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $result = [
            'items' => []
        ];
        $page = $request->get('page', 1);

        $currencies = $this->currencyRepository->getList();
        $pagedCurrencies = $currencies->forPage($page, $this->getPageSize());

        $result['page_info'] = [
            'current_page' => $page,
            'page_size' => $this->getPageSize(),
            'total_items' => $currencies->count(),
            'total_pages' => (int)ceil($currencies->count() / $this->getPageSize()),
        ];

        /** @var Currency $currency */
        foreach ($pagedCurrencies as $currency) {
            $result['items'][] = [
                'currency' => $currency->toArray(),
                'exchange_rate' => $currency->lastExchangeRate()->toArray(),
            ];
        }

        return response()->json($result);
    }

    /**
     * Get page size for currencies
     *
     * @return int
     */
    protected function getPageSize(): int
    {
        // Allow .env file to specify needed size first
        return (int)env('API_CURRENCY_LIST_PAGE_SIZE', static::PAGE_SIZE);
    }
}
