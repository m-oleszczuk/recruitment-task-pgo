<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class LoanProposal
{
    public function __construct(
        #[Assert\Choice([12, 24])]
        public int $term,
        // @phpstan-ignore-next-line
        #[Assert\Range([1000, 20000])]
        public float $amount,
    )
    {
    }
}
