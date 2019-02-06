<?php
declare(strict_types = 1);

namespace Service\Product;

class Sorter
{
    /**
     * @var ISorter
     */

    private $productSorter;

    // тут тоже вместо ISorter почему-то было IProductSorter =)
    public function __construct(ISorter $productSorter)
    {
        $this->productSorter = $productSorter;
    }

    /**
     * @param array $products
     *
     * @return array
     */

    public function sort(array $products): array
    {
        if (!count($products))
        {
            return $products;
        }

        return $this->productSorter->sort($products);
    }
}