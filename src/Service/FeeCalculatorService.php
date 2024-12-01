<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Interface\FeeCalculationStrategyInterface;
use PragmaGoTech\Interview\Interface\FeeCalculatorInterface;
use PragmaGoTech\Interview\Interface\FeeStructureRepositoryInterface;
use PragmaGoTech\Interview\Model\LoanProposal;

readonly class FeeCalculatorService implements FeeCalculatorInterface
{
    public function __construct(
        private FeeStructureRepositoryInterface $feeCalculatorRepository,
        private FeeCalculationStrategyInterface $feeCalculationStrategy,
    )
    {
    }

    public function calculate(LoanProposal $application): float
    {
        $feeStructures = $this->feeCalculatorRepository->getFeeStructureForLoanProposal($application);

        return $this->roundFee(
            $application->amount,
            $this->feeCalculationStrategy->calculateFee($application->amount, $feeStructures->feeStructure),
        );
    }

    private function roundFee(float $loanAmount, float $fee): float
    {
        $total = $loanAmount + $fee;
        $roundedTotal = ceil($total / 5) * 5;

        return $roundedTotal - $loanAmount;
    }
}