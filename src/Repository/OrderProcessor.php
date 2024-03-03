<?php

namespace Pdpaola\CoffeeMachine\Service;

use Pdpaola\CoffeeMachine\Interface\OrderProcessorInterface; 
use Pdpaola\CoffeeMachine\Infrastructure\Database\OrderRepositoryInterface; 
use Pdpaola\CoffeeMachine\Model\ValidatedInput;
use Pdpaola\CoffeeMachine\Entity\DrinkOrder;

class OrderProcessor implements OrderProcessorInterface {
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Processes the order and returns a string with the order details
     * @param ValidatedInput $input
     * @return string
     */
    public function processOrder(ValidatedInput $input): string {
        $prices = [
            'tea' => 0.4,
            'coffee' => 0.5,
            'chocolate' => 0.6,
        ];

        if ($input->money < $prices[$input->drinkType]) {
            throw new \InvalidArgumentException(sprintf('Not enough money. The %s costs %.2f.', $input->drinkType, $prices[$input->drinkType]));
        }
        
        $drinkOrder = new DrinkOrder($input->drinkType, $input->sugars, $input->extraHot, $prices[$input->drinkType]);
        
        $this->orderRepository->insertOrder($drinkOrder);

        $message = sprintf('You have ordered a%s %s', $input->extraHot ? 'n extra hot' : '', $input->drinkType);
        if ($input->sugars > 0) {
            $message .= sprintf(' with %d sugar%s (stick included)', $input->sugars, $input->sugars > 1 ? 's' : '');
        }
        
        return $message;
    }
}