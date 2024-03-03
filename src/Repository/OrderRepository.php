<?php

namespace Pdpaola\CoffeeMachine\Repository;
use Pdpaola\CoffeeMachine\Infrastructure\Database\OrderRepositoryInterface;
use Pdpaola\CoffeeMachine\Entity\DrinkOrder;

class OrderRepository implements OrderRepositoryInterface
{
    private $pdo;

    
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    /**
     * Insert a new order into the database
     * @param DrinkOrder $order
     * @return void
     * 
     */
    public function insertOrder(DrinkOrder $order)
    {
        $stmt = $this->pdo->prepare('INSERT INTO orders (drink_type, sugars, stick, extra_hot) VALUES (:drink_type, :sugars, :stick, :extra_hot)');
        
        $stick = $order->getSugars() > 0;
        $stmt->execute([
            'drink_type' => $order->getDrinkType(),
            'sugars' => $order->getSugars(),
            'stick' => $stick,
            'extra_hot' => $order->isExtraHot(),
        ]);
    }

}