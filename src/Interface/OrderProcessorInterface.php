<?php

namespace Pdpaola\CoffeeMachine\Interface;
use Pdpaola\CoffeeMachine\Model\ValidatedInput;

interface OrderProcessorInterface {

    /**
     * Processes the order and returns a string with the order details
     * @param ValidatedInput $input
     * @return string
     */
    public function processOrder(ValidatedInput $input): string;
}
