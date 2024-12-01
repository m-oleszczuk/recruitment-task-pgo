<?php

declare(strict_types=1);

namespace Tests\Unit\Helper;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Helper\FeeInterpolatorHelper;
use PragmaGoTech\Interview\DTO\FeeStructureLoanToFeeDTO;

class FeeInterpolatorHelperTest extends TestCase
{
    private FeeInterpolatorHelper $helper;

    protected function setUp(): void
    {
        $this->helper = new FeeInterpolatorHelper();
    }

    /** @dataProvider interpolationDataProvider  */
    public function testInterpolateFee(float $previousAmount, float $previousFee, float $nextAmount, float $nextFee, float $loanAmount, float $expectedFee): void
    {
        $previous = new FeeStructureLoanToFeeDTO($previousAmount, $previousFee);
        $next = new FeeStructureLoanToFeeDTO($nextAmount, $nextFee);

        $calculatedFee = $this->helper->interpolateFee($previous, $next, $loanAmount);

        $this->assertEquals($expectedFee, $calculatedFee);
    }

    public function interpolationDataProvider(): array
    {
        return [
            [1000, 50, 2000, 100, 1500, 75.0],
            [1000, 50, 2000, 100, 2000, 100.0],
            [1000, 50, 2000, 100, 1000, 50.0],
            [1000, 50, 2000, 100, 2000, 100.0],
            [1000, 50, 1001, 60, 1000.5, 55.0],
            [10000, 500, 20000, 1000, 15000, 750.0],
        ];
    }
}
