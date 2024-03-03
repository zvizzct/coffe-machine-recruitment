<?php

namespace Pdpaola\CoffeeMachine\Interface;
use Pdpaola\CoffeeMachine\Model\ValidatedInput;

interface InputValidatorInterface {

    /**
     * Validates the input and returns a ValidatedInput object
     * @param mixed $input
     * @return ValidatedInput
     */
    public function validateInput($input): ValidatedInput;
}
