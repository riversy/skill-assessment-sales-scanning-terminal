<?php

namespace Terminal\Order;

use Terminal\Product\ProductRepository;

class TotalCalculator
{
    private ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param string $code
     * @param string $qty
     *
     * @return float
     */
    public function calculateTotal(string $code, string $qty): float
    {
        $product = $this->productRepository->getByCode($code);

        $price = $product->getPrice();
        $tier = $product->getTier() ?: [];

        return $this->calculateTotalWithTier($qty, $price, $tier);
    }

    /**
     * @param int $qty
     * @param float $price
     * @param array $tier
     *
     * @return float
     */
    private function calculateTotalWithTier(int $qty, float $price, array $tier): float
    {
        $total = 0.00;
        $tierQts = array_keys($tier);
        sort($tierQts);

        while (count($tierQts) > 0) {
            $tierQty = array_pop($tierQts);

            if ($qty % $tierQty !== $qty) {
                $subQty = $qty - ($qty % $tierQty);
                $qty -= $subQty;

                $total += $subQty / $tierQty * $tier[$tierQty];
            }
        }

        $total += $qty * $price;

        return $total;
    }
}
