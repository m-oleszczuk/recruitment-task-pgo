<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\DTO;

class FeeStructureDTO
{
    /** @param FeeStructureLoanToFeeDTO[] $feeStructure */
    public function __construct(
        public int $feeTerm,
        public array $feeStructure,
    )
    {
    }
}