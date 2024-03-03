<?php
namespace Pdpaola\CoffeeMachine\Service;

use Pdpaola\CoffeeMachine\Repository\OrderRepository;

class ReportEarnings {
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Returns an array with the earnings by drink type
     * @return array
     */
    public function calculateEarnings(): array {
        return $this->orderRepository->getEarningsByDrinkType();
    }
}
