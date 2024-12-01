<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Repository;

use PragmaGoTech\Interview\DTO\FeeStructureDTO;
use PragmaGoTech\Interview\DTO\FeeStructureLoanToFeeDTO;
use PragmaGoTech\Interview\Exception\FeeStructureException;
use PragmaGoTech\Interview\Interface\FeeStructureRepositoryInterface;
use PragmaGoTech\Interview\Model\LoanProposal;

class InMemoryFeeStructureRepository implements FeeStructureRepositoryInterface
{
    /** @var FeeStructureDTO[] */
    private array $feeStructures;

    public function __construct()
    {
        $this->feeStructures = [
            new FeeStructureDTO(
                12,
                [
                    new FeeStructureLoanToFeeDTO(1000, 50),
                    new FeeStructureLoanToFeeDTO(2000, 90),
                    new FeeStructureLoanToFeeDTO(3000, 90),
                    new FeeStructureLoanToFeeDTO(4000, 115),
                    new FeeStructureLoanToFeeDTO(5000, 100),
                    new FeeStructureLoanToFeeDTO(6000, 120),
                    new FeeStructureLoanToFeeDTO(7000, 140),
                    new FeeStructureLoanToFeeDTO(8000, 160),
                    new FeeStructureLoanToFeeDTO(9000, 180),
                    new FeeStructureLoanToFeeDTO(10000, 200),
                    new FeeStructureLoanToFeeDTO(11000, 220),
                    new FeeStructureLoanToFeeDTO(12000, 240),
                    new FeeStructureLoanToFeeDTO(13000, 260),
                    new FeeStructureLoanToFeeDTO(14000, 280),
                    new FeeStructureLoanToFeeDTO(15000, 300),
                    new FeeStructureLoanToFeeDTO(16000, 320),
                    new FeeStructureLoanToFeeDTO(17000, 340),
                    new FeeStructureLoanToFeeDTO(18000, 360),
                    new FeeStructureLoanToFeeDTO(19000, 380),
                    new FeeStructureLoanToFeeDTO(20000, 400),
                ],
            ),
            new FeeStructureDTO(
                24,
                [
                    new FeeStructureLoanToFeeDTO(1000, 70),
                    new FeeStructureLoanToFeeDTO(2000, 100),
                    new FeeStructureLoanToFeeDTO(3000, 120),
                    new FeeStructureLoanToFeeDTO(4000, 160),
                    new FeeStructureLoanToFeeDTO(5000, 200),
                    new FeeStructureLoanToFeeDTO(6000, 240),
                    new FeeStructureLoanToFeeDTO(7000, 280),
                    new FeeStructureLoanToFeeDTO(8000, 320),
                    new FeeStructureLoanToFeeDTO(9000, 360),
                    new FeeStructureLoanToFeeDTO(10000, 400),
                    new FeeStructureLoanToFeeDTO(11000, 440),
                    new FeeStructureLoanToFeeDTO(12000, 480),
                    new FeeStructureLoanToFeeDTO(13000, 520),
                    new FeeStructureLoanToFeeDTO(14000, 560),
                    new FeeStructureLoanToFeeDTO(15000, 600),
                    new FeeStructureLoanToFeeDTO(16000, 640),
                    new FeeStructureLoanToFeeDTO(17000, 680),
                    new FeeStructureLoanToFeeDTO(18000, 720),
                    new FeeStructureLoanToFeeDTO(19000, 760),
                    new FeeStructureLoanToFeeDTO(20000, 800)
                ],
            ),
        ];
    }

    /** @return FeeStructureDTO[] */
    public function allAvailableFeeStructures(): array
    {
        return $this->feeStructures;
    }

    public function getFeeStructureForLoanProposal(LoanProposal $loanProposal): FeeStructureDTO
    {
        foreach ($this->feeStructures as $feeStructure) {
            if ($feeStructure->feeTerm === $loanProposal->term) {
                return $feeStructure;
            }
        }

        throw FeeStructureException::termUnavailable($loanProposal->term);
    }
}