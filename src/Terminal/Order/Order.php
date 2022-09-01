<?php

namespace Terminal\Order;

use Terminal\Product\ProductRepository;

class Order
{
    /**
     * @var array
     */
    private $productQty = [];

    /**
     * @var TotalCalculator
     */
    private TotalCalculator $totalCalculator;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->totalCalculator = new TotalCalculator($productRepository);
    }

    /**
     * @param string $code
     *
     * @return void
     */
    public function addToOrder(string $code): void
    {
        if (isset($this->productQty[$code])) {
            $this->productQty[$code]++;
        } else {
            $this->productQty[$code] = 1;
        }
    }

    /**
     * @return float
     */
    public function collectTotal(): float
    {
        $total = 0.00;
        foreach ($this->productQty as $code => $qty) {
            $total += $this->totalCalculator->calculateTotal($code, $qty);
        }

        return $total;
    }
}
