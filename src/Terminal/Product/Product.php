<?php

namespace Terminal\Product;

class Product
{
    private string $code;
    private float $price;
    private ?array $tier;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return array|null
     */
    public function getTier(): ?array
    {
        return $this->tier;
    }

    /**
     * @param array|null $tier
     */
    public function setTier(?array $tier): void
    {
        $this->tier = $tier;
    }
}
