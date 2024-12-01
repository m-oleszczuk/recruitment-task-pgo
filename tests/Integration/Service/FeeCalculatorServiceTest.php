<?php

declare(strict_types=1);

namespace Tests\Integration\Service;

use PragmaGoTech\Interview\DTO\FeeStructureDTO;
use PragmaGoTech\Interview\DTO\FeeStructureLoanToFeeDTO;
use PragmaGoTech\Interview\Interface\FeeStructureRepositoryInterface;
use PragmaGoTech\Interview\Service\FeeCalculatorService;
use PragmaGoTech\Interview\Repository\InMemoryFeeStructureRepository;
use PragmaGoTech\Interview\Helper\FeeInterpolatorHelper;
use PragmaGoTech\Interview\Model\LoanProposal;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Strategy\InterpolatedFeeStrategy;

class FeeCalculatorServiceTest extends TestCase
{

    private FeeCalculatorService $feeCalculatorService;
    private FeeStructureRepositoryInterface $feeStructureRepository;

    protected function setUp(): void
    {
        $feeInterpolatorHelper = new FeeInterpolatorHelper();
        // For the ease of testing, regularly you'd use a mock, but I wanted to test concrete data here
        $this->feeStructureRepository = new InMemoryFeeStructureRepository();

        $feeCalculationStrategy = new InterpolatedFeeStrategy($feeInterpolatorHelper);
        $this->feeCalculatorService = new FeeCalculatorService(
            $this->feeStructureRepository,
            $feeCalculationStrategy
        );
    }

    /** @dataProvider loanAmountFeeProvider */
    public function testFeeCalculationWithRealData(float $loanAmount, int $term, float $expectedFee): void
    {
        $loanProposal = new LoanProposal($term, $loanAmount);
        $calculatedFee = $this->feeCalculatorService->calculate($loanProposal);

        $this->assertEquals($expectedFee, $calculatedFee);
    }

    /**
     * Data provider for testFeeCalculationWithRealData
     */
    public function loanAmountFeeProvider(): array
    {
        return [
            //regular
            [1500, 12, 70.0],
            [2000, 12, 90.0],
            [3500, 12, 105.0],
            [5000, 12, 100.0],
            [5000, 24, 200.0],
            [10000, 12, 200.0],
            [10000, 24, 400.0],
            [20000, 12, 400.0],
            [20000, 24, 800.0],

            //boundary
            [999, 12, 51.0],
            [10000, 24, 400.0],
            [15001, 24, 604.0],
            [15001, 12, 304.0],

            //interpolation
            [2500, 12, 90.0],
            [3500, 24, 140.0],
            [9500, 12, 190.0],
        ];
    }
}