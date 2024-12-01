<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Repository\InMemoryFeeStructureRepository;
use PragmaGoTech\Interview\Service\FeeCalculatorService;
use PragmaGoTech\Interview\Interface\FeeCalculationStrategyInterface;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculatorServiceTest extends TestCase
{
    private FeeCalculatorService $feeCalculatorService;
    private $feeCalculatorRepository;
    private $feeCalculationStrategy;

    protected function setUp(): void
    {
        // For the ease of testing; normally you'd use a mock, but I wanted to test all the aforementioned cases
        $this->feeCalculatorRepository = new InMemoryFeeStructureRepository();
        $this->feeCalculationStrategy = $this->createMock(FeeCalculationStrategyInterface::class);

        $this->feeCalculatorService = new FeeCalculatorService(
            $this->feeCalculatorRepository,
            $this->feeCalculationStrategy
        );
    }

    /** @dataProvider loanAmountFeeProvider */
    public function testCalculateWithInterpolatedFee(float $loanAmount, int $term, float $expectedFee): void
    {
        $this->feeCalculationStrategy
            ->method('calculateFee')
            ->willReturn($expectedFee);

        $loanProposal = new LoanProposal($term, $loanAmount);
        $calculatedFee = $this->feeCalculatorService->calculate($loanProposal);

        $this->assertEquals($expectedFee, $calculatedFee);
    }

    public function loanAmountFeeProvider(): array
    {
        return [
            [1000.00, 12, 50.00],
            [5000.00, 12, 100.00],
            [20000.00, 12, 400.00],
            [1000.00, 24, 70.00],
            [5000.00, 24, 200.00],
            [20000.00, 24, 800.00],
            [1500.00, 12, 70.00],
            [7500.00, 12, 150.00],
            [1500.00, 24, 85.00],
            [7500.00, 24, 300.00],
        ];
    }
}