<?php

namespace Pdpaola\CoffeeMachine\Entity;

class DrinkOrder
{
    private $id;
    private $drinkType;
    private $sugars;
    private $extraHot;
    private $cost;

    public function __construct(
        string $drinkType,
        int $sugars,
        bool $extraHot,
        float $cost
    ) {
        $this->drinkType = $drinkType;
        $this->sugars = $sugars;
        $this->extraHot = $extraHot;
        $this->cost = $cost;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDrinkType()
    {
        return $this->drinkType;
    }

    public function getSugars()
    {
        return $this->sugars;
    }

    public function isExtraHot()
    {
        return $this->extraHot;
    }

    public function getCost()
    {
        return $this->cost;
    }
}
