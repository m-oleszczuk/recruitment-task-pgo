<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Interface;

use PragmaGoTech\Interview\DTO\FeeStructureDTO;
use PragmaGoTech\Interview\Model\LoanProposal;

interface FeeStructureRepositoryInterface
{
    /** @return FeeStructureDTO[] */
    public function allAvailableFeeStructures(): array;

    public function getFeeStructureForLoanProposal(LoanProposal $loanProposal): FeeStructureDTO;
}