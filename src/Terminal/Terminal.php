<?php

namespace Terminal;

use Terminal\Order\Order;
use Terminal\Product\ProductBuilder;
use Terminal\Product\ProductRepository;

class Terminal
{
    public float $total = 0.00;
    private Order $order;

    /**
     * @param array $pricing
     *
     * @return $this
     */
    public function setPricing(array $pricing): Terminal
    {
        $productRepository = new ProductRepository();
        $productBuilder = new ProductBuilder();

        foreach ($pricing as $code => $priceData) {
            $price = (float)$priceData['price'];
            $tier = $priceData['tier'] ?? null;

            $product = $productBuilder
                ->setCode($code)
                ->setPrice($price)
                ->setTier($tier)
                ->build();

            $productRepository->add($product);
        }

        $this->order = new Order($productRepository);

        return $this;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function scan(string $code): Terminal
    {
        $this->order->addToOrder($code);
        $this->total = $this->order->collectTotal();

        return $this;
    }
}
