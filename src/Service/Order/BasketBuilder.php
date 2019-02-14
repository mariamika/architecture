<?php
declare(strict_types = 1);

namespace Service\Order;

use Service\Billing\IBilling;
use Service\Communication\ICommunication;
use Service\Discount\IDiscount;
use Service\User\ISecurity;
use Model\Entity\Product;

class BasketBuilder
{
    /**
     * @var IBilling
     */
    private $billing;

    /**
     * @var IDiscount
     */
    private $discount;

    /**
     * @var ICommunication
     */
    private $communication;

    /**
     * @var ISecurity
     */
    private $security;

    /**
     * @var Product[]
     */
    private $products;




    /**
     * @return IBilling
     */
    public function getBilling(): IBilling
    {
        return $this->billing;
    }

    /**
     * @param IBilling $billing
     * @return BasketBuilder
     */
    public function setBilling(IBilling $billing): BasketBuilder
    {
        $this->billing = $billing;
        return $this;
    }

    /**
     * @return IDiscount
     */
    public function getDiscount(): IDiscount
    {
        return $this->discount;
    }

    /**
     * @param IDiscount $discount
     * @return BasketBuilder
     */
    public function setDiscount(IDiscount $discount): BasketBuilder
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return ICommunication
     */
    public function getCommunication(): ICommunication
    {
        return $this->communication;
    }

    /**
     * @param ICommunication $communication
     * @return BasketBuilder
     */
    public function setCommunication(ICommunication $communication): BasketBuilder
    {
        $this->communication = $communication;
        return $this;
    }

    /**
     * @return ISecurity
     */
    public function getSecurity(): ISecurity
    {
        return $this->security;
    }

    /**
     * @param ISecurity $security
     * @return BasketBuilder
     */
    public function setSecurity(ISecurity $security): BasketBuilder
    {
        $this->security = $security;
        return $this;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     * @return BasketBuilder
     */
    public function setProducts(array $products): BasketBuilder
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return Checkout
     */
    // Создает целевой класс
    public function builder(): Checkout
    {
        // В качестве аргумента передаем самого себя!
        return new Checkout($this);
    }
}