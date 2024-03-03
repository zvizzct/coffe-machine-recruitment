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
     /**
     * Get the earnings by drink type
     * @return array
     * 
     */
    public function getEarningsByDrinkType(): array
    {
        $prices = ['tea' => 0.4, 'coffee' => 0.5, 'chocolate' => 0.6];

        $stmt = $this->pdo->query('SELECT drink_type, COUNT(*) as quantity FROM orders GROUP BY drink_type');
        $earnings = [];
        while ($row = $stmt->fetch()) {

            $earnings[$row['drink_type']] = $row['quantity'] * ($prices[$row['drink_type']] ?? 0);
        }
        return $earnings;
    }

}