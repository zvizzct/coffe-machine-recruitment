<?php

namespace Pdpaola\CoffeeMachine\Infrastructure\Database;

use Pdpaola\CoffeeMachine\Entity\DrinkOrder;

interface OrderRepositoryInterface
{   

    public function insertOrder(DrinkOrder $order);
    public function getEarningsByDrinkType(): array;  

}