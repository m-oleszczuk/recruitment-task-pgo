<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Interface;

use PragmaGoTech\Interview\DTO\FeeStructureLoanToFeeDTO;

interface FeeCalculationStrategyInterface
{
    /** @param FeeStructureLoanToFeeDTO[] $feeStructures */
    public function calculateFee(float $loanAmount, array $feeStructures): float;
}