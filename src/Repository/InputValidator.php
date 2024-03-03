<?php

namespace Pdpaola\CoffeeMachine\Service;


use Symfony\Component\Console\Input\InputInterface;
use Pdpaola\CoffeeMachine\Model\ValidatedInput;
use Pdpaola\CoffeeMachine\Interface\InputValidatorInterface;

class InputValidator implements InputValidatorInterface {

    /**
     * Validates the input and returns a ValidatedInput object
     * @param InputInterface $input
     * @return ValidatedInput
     */
    public function validateInput($input): ValidatedInput {
        $drinkType = strtolower($input->getArgument('drink-type'));
        if (!in_array($drinkType, ['tea', 'coffee', 'chocolate'])) {
            throw new \InvalidArgumentException('The drink type should be tea, coffee, or chocolate.');
        }

        $money = (float) $input->getArgument('money');
        if ($money <= 0) {
            throw new \InvalidArgumentException('The amount of money must be greater than 0.');
        }

        $sugars = (int) $input->getArgument('sugars');
        if ($sugars < 0 || $sugars > 2) {
            throw new \InvalidArgumentException('The number of sugars should be between 0 and 2.');
        }

        $extraHot = $input->getOption('extra-hot');

        return new ValidatedInput($drinkType, $money, $sugars, $extraHot);
    }
}
