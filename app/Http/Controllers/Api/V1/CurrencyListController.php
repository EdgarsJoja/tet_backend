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
        $result = [];

        $currencies = $this->currencyRepository->getList();

        /** @var Currency $currency */
        foreach ($currencies as $currency) {
            $result[] = [
                'currency' => $currency->toArray(),
                'exchange_rate' => $currency->lastExchangeRate()->toArray(),
            ];
        }

        return response()->json($result);
    }
}
