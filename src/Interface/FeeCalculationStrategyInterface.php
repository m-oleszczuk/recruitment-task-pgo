<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Interface;

interface FeeCalculationStrategyInterface
{
    public function calculateFee(float $loanAmount, array $feeStructures): float;
}