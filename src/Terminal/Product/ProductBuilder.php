<?php

namespace Terminal\Product;

class ProductBuilder
{
    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->product->setCode($code);

        return $this;
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice(float $price)
    {
        $this->product->setPrice($price);

        return $this;
    }

    /**
     * @param array|null $tier
     *
     * @return void
     */
    public function setTier(?array $tier)
    {
        $this->product->setTier($tier);

        return $this;
    }

    /**
     * @return Product
     */
    public function build()
    {
        $readyProduct = clone $this->product;
        $this->product = new Product();

        return $readyProduct;
    }
}
