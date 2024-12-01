<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Exception;

use Exception;

class FeeStructureException extends Exception
{
    public static function termUnavailable(int $term): self
    {
        return new self(sprintf('Fee structure is not available for term %s', $term));
    }
}