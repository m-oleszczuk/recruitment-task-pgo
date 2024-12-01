<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Strategy;

use PragmaGoTech\Interview\Helper\FeeInterpolatorHelper;
use PragmaGoTech\Interview\Interface\FeeCalculationStrategyInterface;

// Could expand the Strategy approach with a strategy factory and injecting it via factory to the service
class InterpolatedFeeStrategy implements FeeCalculationStrategyInterface
{
    private FeeInterpolatorHelper $feeInterpolatorHelper;

    public function __construct(FeeInterpolatorHelper $feeInterpolatorHelper)
    {
        $this->feeInterpolatorHelper = $feeInterpolatorHelper;
    }

    public function calculateFee(float $loanAmount, array $feeStructures): float
    {
        $previousBreakpoint = null;
        foreach ($feeStructures as $dto) {
            if ($loanAmount < $dto->amount) {
                return $previousBreakpoint !== null
                    ? $this->feeInterpolatorHelper->interpolateFee($previousBreakpoint, $dto, $loanAmount)
                    : $dto->fee;
            }
            $previousBreakpoint = $dto;
        }
        return $previousBreakpoint ? $previousBreakpoint->fee : 0;
    }
}