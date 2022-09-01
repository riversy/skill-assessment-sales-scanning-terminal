<?php

namespace Terminal\Product;

use RuntimeException;

class ProductRepository
{
    /**
     * @var Product[]
     */
    private array $products = [];

    /**
     * @param Product $product
     *
     * @return void
     */
    public function add(Product $product): void
    {
        $this->products[] = $product;
    }

    /**
     * @param string $code
     *
     * @return Product
     *
     */
    public function getByCode(string $code): Product
    {
        $filteredProducts = array_filter(
            $this->products,
            static function (Product $product) use ($code) {
                return $product->getCode() === $code;
            }
        );

        if (count($filteredProducts) > 0) {
            return array_pop($filteredProducts);
        }

        throw new RuntimeException(
            sprintf('product with code %s is not found', $code)
        );
    }
}
