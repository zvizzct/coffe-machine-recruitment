<?php

namespace Pdpaola\CoffeeMachine\Model;

class ValidatedInput {
    public $drinkType;
    public $money;
    public $sugars;
    public $extraHot;


    public function __construct(string $drinkType, float $money, int $sugars, bool $extraHot) {
        $this->drinkType = $drinkType;
        $this->money = $money;
        $this->sugars = $sugars;
        $this->extraHot = $extraHot;
    }

}
