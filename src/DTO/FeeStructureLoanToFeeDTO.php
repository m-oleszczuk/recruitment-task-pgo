<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class FeeStructureLoanToFeeDTO
{
    public function __construct(
        #[Assert\Range([1000, 20000])]
        public float $amount,
        #[Assert\NotBlank]
        public float $fee,
    )
    {
    }
}