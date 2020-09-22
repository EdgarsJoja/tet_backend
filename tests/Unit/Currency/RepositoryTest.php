<?php

namespace Tests\Unit\Currency;

use App\Currency;
use App\Currency\CurrencyRepository;
use App\Currency\CurrencyValidationInterface;
use Mockery;
use Tests\TestCase;

/**
 * Class RepositoryTest
 * @package Tests\Unit\Currency
 */
class RepositoryTest extends TestCase
{
    /**
     * @var CurrencyValidationInterface|Mockery\LegacyMockInterface|Mockery\MockInterface
     */
    protected $validationMock;

    protected $currencyMock;

    /**
     * Run before every test
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->validationMock = Mockery::mock(CurrencyValidationInterface::class);
        $this->currencyMock = Mockery::mock(Currency::class);
    }

    /**
     * Test that save method is correctly called
     */
    public function testSaveIsCalled(): void
    {
        $this->validationMock->shouldReceive('validate')->andReturn(true);
        $this->currencyMock->shouldReceive('save')->once();

        $repository = new CurrencyRepository($this->validationMock);

        self::assertTrue($repository->save($this->currencyMock));
    }

    /**
     * Test that model save is not called due to validation fail
     */
    public function testSaveIsNotCalled(): void
    {
        $this->validationMock->shouldReceive('validate')->andReturn(false);
        $this->currencyMock->shouldReceive('save')->never();

        $repository = new CurrencyRepository($this->validationMock);

        self::assertFalse($repository->save($this->currencyMock));
    }
}
