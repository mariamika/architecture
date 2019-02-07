<?php
declare(strict_types = 1);

namespace Service\Product;
use Model\Entity\Product;

class SorterByPrice implements ISorter
{
    /**
     * @inheritdoc
     */

    public function sort(array $products): array
    {
        $sortFunction = function(Product $a, Product $b)
        {
            if ($a->getPrice() === $b->getPrice())
            {return 0;}

            return $a->getPrice() < $b->getPrice() ? -1 : 1;
        };

        usort($products, $sortFunction);

        return $products;
    }
}