<?php

declare(strict_types = 1);

namespace Service\Product;

use Model;

class Product
{
    /**
     * Получаем информацию по конкретному продукту
     *
     * @param int $id
     * @return Model\Entity\Product|null
     */
    public function getInfo(int $id): ?Model\Entity\Product
    {
        $product = $this->getProductRepository()->search([$id]);
        return count($product) ? $product[0] : null;
    }

    /**
     * Получаем все продукты
     *
     * @param string $sortType
     *
     * @return Model\Entity\Product[]
     */
    public function getAll(string $sortType): array
    {
        switch($sortType){
            case 'price':
                $strategy = new Sorter(new SorterByPrice());
                break;

            case 'name':
                $strategy = new Sorter(new SorterByName());
                break;

            default:
                $strategy = new Sorter(new SorterByName());
        }

        $productList = $this->getProductRepository()->fetchAll();


        // в примере здесь вместо $strategy почему-то стояло $productSorter =)
        return $strategy->sort($productList);
    }

    /**
     * Фабричный метод для репозитория Product
     *
     * @return Model\Repository\Product
     */
    protected function getProductRepository(): Model\Repository\Product
    {
        return new Model\Repository\Product();
    }
}
