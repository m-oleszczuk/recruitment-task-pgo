<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Helper;

use PragmaGoTech\Interview\DTO\FeeStructureLoanToFeeDTO;

class FeeInterpolatorHelper
{
    public function interpolateFee(
        FeeStructureLoanToFeeDTO $previous,
        FeeStructureLoanToFeeDTO $next,
        float $loanAmount,
    ): float
    {
        $amountRange = $next->amount - $previous->amount;
        $feeRange = $next->fee - $previous->fee;

        return $previous->fee + (($loanAmount - $previous->amount) / $amountRange) * $feeRange;
    }
}