<?php

namespace Terminal;

use PHPUnit\Framework\TestCase;

class TerminalTest extends TestCase
{
    private array $pricing = [
        'A' => [
            'price' => 2.00,
            'tier' => [
                4 => 7.00
            ],
        ],
        'B' => [
            'price' => 12.00,
        ],
        'C' => [
            'price' => 1.25,
            'tier' => [
                6 => 6.00
            ],
        ],
        'D' => [
            'price' => 0.15,
        ],
    ];

    public function testScanA()
    {
        $this->customTest('A',  2.00);
    }

    public function testScanABCDABAA()
    {
        $this->customTest('ABCDABAA',  32.4);
    }

    public function testScanCCCCCCC()
    {
        $this->customTest('CCCCCCC',   7.25);
    }

    public function testScanABCD()
    {
        $this->customTest('ABCD',  15.4);
    }

    /**
     * @param string $codes
     * @param float $expectedValue
     *
     * @return void
     */
    private function customTest(string $order, float $expectedValue): void
    {
        $terminal = new Terminal();
        $terminal->setPricing($this->pricing);

        $codes = str_split($order);
        foreach($codes as $code){
            $terminal->scan($code);
        }

        $this->assertEquals(
            $expectedValue,
            $terminal->total,
            sprintf('testing order %s', $order)
        );
    }
}
