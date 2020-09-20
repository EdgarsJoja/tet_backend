<?php

namespace App\Http\Controllers\Api\V1;

use App\Currency\CurrencyRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

/**
 * Class CurrencyController
 * @package App\Http\Controllers\Api\V1
 */
class CurrencyController extends Controller
{
    /**
     * @var CurrencyRepositoryInterface
     */
    protected $currencyRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * CurrencyController constructor.
     * @param CurrencyRepositoryInterface $currencyRepository
     * @param LoggerInterface $logger
     */
    public function __construct(CurrencyRepositoryInterface $currencyRepository, LoggerInterface $logger)
    {
        $this->currencyRepository = $currencyRepository;
        $this->logger = $logger;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function __invoke(Request $request, $id)
    {
        $result = [];

        try {
            $currency = $this->currencyRepository->getById($id);
            $exchangeRates = $currency->exchangeRates()->orderByDesc('date')->get();

            $result['currency'] = $currency->toArray();
            $result['exchange_rates'] = $exchangeRates->toArray();
        } catch (ModelNotFoundException $exception) {
            $this->logger->error($exception->getMessage());
        }

        return response()->json($result);
    }
}
